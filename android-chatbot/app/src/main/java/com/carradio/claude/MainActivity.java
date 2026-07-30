package com.carradio.claude;

import android.Manifest;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.os.Handler;
import android.os.Looper;
import android.speech.RecognitionListener;
import android.speech.RecognizerIntent;
import android.speech.SpeechRecognizer;
import android.speech.tts.TextToSpeech;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ScrollView;
import android.widget.TextView;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class MainActivity extends AppCompatActivity implements TextToSpeech.OnInitListener {

    private static final int MIC_PERMISSION = 1;
    private static final String PREFS = "claude_car";
    private static final String API_URL = "https://api.anthropic.com/v1/messages";

    private SpeechRecognizer speechRecognizer;
    private TextToSpeech tts;
    private TextView conversationView;
    private TextView statusView;
    private Button micButton;
    private ScrollView scrollView;
    private SharedPreferences prefs;
    private Handler handler = new Handler(Looper.getMainLooper());
    private List<JSONObject> messages = new ArrayList<>();
    private boolean isListening = false;
    private boolean ttsReady = false;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        prefs = getSharedPreferences(PREFS, MODE_PRIVATE);
        conversationView = findViewById(R.id.conversationView);
        statusView = findViewById(R.id.statusView);
        micButton = findViewById(R.id.micButton);
        scrollView = findViewById(R.id.scrollView);

        tts = new TextToSpeech(this, this);

        micButton.setOnClickListener(v -> {
            if (isListening) {
                stopListening();
            } else {
                checkMicAndListen();
            }
        });

        findViewById(R.id.settingsButton).setOnClickListener(v -> showApiKeyDialog());
        findViewById(R.id.clearButton).setOnClickListener(v -> clearConversation());

        if (prefs.getString("api_key", "").isEmpty()) {
            showApiKeyDialog();
        } else {
            appendConversation("Claude Auto pret. Appuie sur le bouton pour parler.");
        }
    }

    private void checkMicAndListen() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.RECORD_AUDIO)
                != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this,
                    new String[]{Manifest.permission.RECORD_AUDIO}, MIC_PERMISSION);
        } else {
            startListening();
        }
    }

    @Override
    public void onRequestPermissionsResult(int req, String[] perms, int[] results) {
        super.onRequestPermissionsResult(req, perms, results);
        if (req == MIC_PERMISSION && results.length > 0
                && results[0] == PackageManager.PERMISSION_GRANTED) {
            startListening();
        } else {
            statusView.setText("Permission micro refusee");
        }
    }

    private void startListening() {
        if (prefs.getString("api_key", "").isEmpty()) {
            showApiKeyDialog();
            return;
        }

        isListening = true;
        micButton.setText("STOP");
        micButton.setBackgroundColor(0xFFCC0000);
        statusView.setText("Ecoute...");

        if (speechRecognizer != null) speechRecognizer.destroy();
        speechRecognizer = SpeechRecognizer.createSpeechRecognizer(this);

        Intent intent = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL,
                RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE, "fr-FR");
        intent.putExtra(RecognizerIntent.EXTRA_MAX_RESULTS, 1);
        intent.putExtra(RecognizerIntent.EXTRA_PARTIAL_RESULTS, true);

        speechRecognizer.setRecognitionListener(new RecognitionListener() {
            @Override
            public void onResults(Bundle results) {
                ArrayList<String> matches = results.getStringArrayList(
                        SpeechRecognizer.RESULTS_RECOGNITION);
                isListening = false;
                resetMicButton();
                if (matches != null && !matches.isEmpty() && !matches.get(0).isEmpty()) {
                    String text = matches.get(0);
                    appendConversation("Vous: " + text);
                    sendToClaude(text);
                } else {
                    statusView.setText("Rien entendu. Reessaye.");
                }
            }

            @Override
            public void onError(int error) {
                isListening = false;
                resetMicButton();
                String msg;
                switch (error) {
                    case SpeechRecognizer.ERROR_NO_MATCH: msg = "Pas compris. Reessaye."; break;
                    case SpeechRecognizer.ERROR_NETWORK: msg = "Erreur reseau micro."; break;
                    default: msg = "Erreur micro (" + error + "). Reessaye.";
                }
                statusView.setText(msg);
            }

            @Override public void onReadyForSpeech(Bundle p) { statusView.setText("Parle maintenant..."); }
            @Override public void onBeginningOfSpeech() {}
            @Override public void onRmsChanged(float r) {}
            @Override public void onBufferReceived(byte[] b) {}
            @Override public void onEndOfSpeech() { statusView.setText("Traitement..."); }
            @Override public void onPartialResults(Bundle partial) {
                ArrayList<String> p = partial.getStringArrayList(SpeechRecognizer.RESULTS_RECOGNITION);
                if (p != null && !p.isEmpty()) statusView.setText("\"" + p.get(0) + "\"");
            }
            @Override public void onEvent(int t, Bundle p) {}
        });

        speechRecognizer.startListening(intent);
    }

    private void stopListening() {
        if (speechRecognizer != null) speechRecognizer.stopListening();
        isListening = false;
        resetMicButton();
        statusView.setText("Annule.");
    }

    private void resetMicButton() {
        micButton.setText("PARLER");
        micButton.setBackgroundColor(0xFF6200EE);
    }

    private void sendToClaude(String userMessage) {
        statusView.setText("Claude reflechit...");
        String apiKey = prefs.getString("api_key", "");

        try {
            JSONObject userMsg = new JSONObject();
            userMsg.put("role", "user");
            userMsg.put("content", userMessage);
            messages.add(userMsg);
        } catch (Exception e) {
            e.printStackTrace();
        }

        // Keep max 10 messages to avoid token overload
        while (messages.size() > 10) messages.remove(0);

        new Thread(() -> {
            try {
                URL url = new URL(API_URL);
                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setRequestMethod("POST");
                conn.setRequestProperty("Content-Type", "application/json");
                conn.setRequestProperty("x-api-key", apiKey);
                conn.setRequestProperty("anthropic-version", "2023-06-01");
                conn.setDoOutput(true);
                conn.setConnectTimeout(15000);
                conn.setReadTimeout(30000);

                JSONObject body = new JSONObject();
                body.put("model", "claude-haiku-4-5-20251001");
                body.put("max_tokens", 400);
                body.put("system", "Tu es un assistant de bord dans une VW Tiguan 2009. " +
                        "Reponds en francais, de facon courte et claire (2-3 phrases max). " +
                        "Parle naturellement, sans puces ni titres. " +
                        "Tu peux aider avec la navigation, la mecanique, la musique, ou toute question.");

                JSONArray msgArray = new JSONArray();
                for (JSONObject m : messages) msgArray.put(m);
                body.put("messages", msgArray);

                OutputStream os = conn.getOutputStream();
                os.write(body.toString().getBytes("UTF-8"));
                os.close();

                int responseCode = conn.getResponseCode();
                BufferedReader br;
                if (responseCode == 200) {
                    br = new BufferedReader(new InputStreamReader(conn.getInputStream(), "UTF-8"));
                } else {
                    br = new BufferedReader(new InputStreamReader(conn.getErrorStream(), "UTF-8"));
                }

                StringBuilder sb = new StringBuilder();
                String line;
                while ((line = br.readLine()) != null) sb.append(line);
                br.close();

                if (responseCode == 200) {
                    JSONObject response = new JSONObject(sb.toString());
                    String replyText = response.getJSONArray("content")
                            .getJSONObject(0).getString("text");

                    JSONObject assistantMsg = new JSONObject();
                    assistantMsg.put("role", "assistant");
                    assistantMsg.put("content", replyText);
                    messages.add(assistantMsg);

                    final String finalReply = replyText;
                    handler.post(() -> {
                        appendConversation("Claude: " + finalReply);
                        statusView.setText("Appuie pour parler");
                        if (ttsReady) speak(finalReply);
                    });
                } else {
                    final String errBody = sb.toString();
                    handler.post(() -> {
                        statusView.setText("Erreur API " + responseCode);
                        if (responseCode == 401) {
                            appendConversation("[Cle API invalide. Va dans Reglages.]");
                        } else {
                            appendConversation("[Erreur " + responseCode + ": " + errBody + "]");
                        }
                    });
                    // Remove the user message we added since we got an error
                    if (!messages.isEmpty()) messages.remove(messages.size() - 1);
                }

            } catch (Exception e) {
                final String err = e.getMessage();
                handler.post(() -> {
                    statusView.setText("Erreur reseau");
                    appendConversation("[Erreur: " + err + "]");
                });
                if (!messages.isEmpty()) messages.remove(messages.size() - 1);
            }
        }).start();
    }

    private void speak(String text) {
        tts.speak(text, TextToSpeech.QUEUE_FLUSH, null, "claude_reply");
    }

    private void appendConversation(String text) {
        String current = conversationView.getText().toString();
        if (!current.isEmpty()) current += "\n\n";
        conversationView.setText(current + text);
        scrollView.post(() -> scrollView.fullScroll(View.FOCUS_DOWN));
    }

    private void clearConversation() {
        messages.clear();
        conversationView.setText("");
        statusView.setText("Conversation effacee.");
    }

    private void showApiKeyDialog() {
        EditText input = new EditText(this);
        input.setHint("sk-ant-api03-...");
        input.setText(prefs.getString("api_key", ""));
        input.setPadding(40, 20, 40, 20);

        new AlertDialog.Builder(this)
                .setTitle("Cle API Anthropic")
                .setMessage("Entre ta cle API depuis console.anthropic.com :")
                .setView(input)
                .setPositiveButton("OK", (d, w) -> {
                    String key = input.getText().toString().trim();
                    prefs.edit().putString("api_key", key).apply();
                    if (!key.isEmpty()) {
                        statusView.setText("Cle API enregistree. Appuie pour parler.");
                    }
                })
                .setNegativeButton("Annuler", null)
                .show();
    }

    @Override
    public void onInit(int status) {
        if (status == TextToSpeech.SUCCESS) {
            int result = tts.setLanguage(Locale.FRENCH);
            ttsReady = (result != TextToSpeech.LANG_MISSING_DATA
                    && result != TextToSpeech.LANG_NOT_SUPPORTED);
        }
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        if (speechRecognizer != null) speechRecognizer.destroy();
        if (tts != null) {
            tts.stop();
            tts.shutdown();
        }
    }
}
