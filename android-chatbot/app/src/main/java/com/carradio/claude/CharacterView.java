package com.carradio.claude;

import android.content.Context;
import android.graphics.Canvas;
import android.graphics.Color;
import android.graphics.Paint;
import android.graphics.Path;
import android.graphics.RectF;
import android.os.Handler;
import android.os.Looper;
import android.util.AttributeSet;
import android.view.View;

public class CharacterView extends View {

    public enum State { IDLE, LISTENING, THINKING, SPEAKING }

    private State state = State.IDLE;
    private int frame = 0;
    private boolean blinking = false;
    private int blinkTimer = 0;
    private final Handler handler = new Handler(Looper.getMainLooper());
    private Runnable animRunnable;
    private final Paint paint = new Paint(Paint.ANTI_ALIAS_FLAG);

    public CharacterView(Context ctx) { super(ctx); init(); }
    public CharacterView(Context ctx, AttributeSet attrs) { super(ctx, attrs); init(); }
    public CharacterView(Context ctx, AttributeSet attrs, int def) { super(ctx, attrs, def); init(); }

    private void init() {
        animRunnable = () -> {
            frame++;
            blinkTimer++;
            if (blinkTimer > 90) { blinking = true; }
            if (blinkTimer > 96) { blinking = false; blinkTimer = 0; }
            invalidate();
            handler.postDelayed(animRunnable, 33);
        };
        handler.post(animRunnable);
    }

    public void setState(State s) { state = s; }

    @Override
    protected void onDraw(Canvas canvas) {
        int w = getWidth(), h = getHeight();
        float cx = w / 2f;
        float cy = h * 0.50f;

        float bob = 0;
        if (state == State.IDLE)     bob = (float) Math.sin(frame * 0.06) * 3f;
        if (state == State.SPEAKING) bob = (float) Math.sin(frame * 0.18) * 5f;
        cy += bob;

        float R = Math.min(w, h) * 0.27f;

        // Antenna stem
        paint.setStyle(Paint.Style.STROKE);
        paint.setColor(0xFF7c3aed);
        paint.setStrokeWidth(3f);
        canvas.drawLine(cx, cy - R, cx, cy - R - R * 0.55f, paint);

        // Antenna ball
        int antCol = state == State.LISTENING ? 0xFFff4444
                   : state == State.THINKING  ? 0xFF44cc00
                   : state == State.SPEAKING  ? 0xFFc084fc
                   : 0xFF7c3aed;
        float antR = R * 0.18f;
        float antY = cy - R - R * 0.55f - antR;
        paint.setStyle(Paint.Style.FILL);
        paint.setColor(antCol);
        canvas.drawCircle(cx, antY, antR, paint);

        if (state == State.LISTENING || state == State.SPEAKING) {
            float halo = antR + (float) Math.abs(Math.sin(frame * 0.22)) * antR + antR * 0.6f;
            paint.setStyle(Paint.Style.STROKE);
            paint.setColor(antCol & 0x55FFFFFF);
            paint.setStrokeWidth(2f);
            canvas.drawCircle(cx, antY, halo, paint);
        }

        // Head fill
        int headFill = state == State.LISTENING ? 0xFF2a0066
                     : state == State.THINKING  ? 0xFF002800
                     : 0xFF1a0044;
        int headEdge = state == State.LISTENING ? 0xFF9900ff
                     : state == State.THINKING  ? 0xFF00aa44
                     : 0xFF7c3aed;
        paint.setStyle(Paint.Style.FILL);
        paint.setColor(headFill);
        canvas.drawCircle(cx, cy, R, paint);
        paint.setStyle(Paint.Style.STROKE);
        paint.setColor(headEdge);
        paint.setStrokeWidth(3f);
        canvas.drawCircle(cx, cy, R, paint);

        // Ears
        float eW = state == State.LISTENING ? R * 0.22f : R * 0.13f;
        float eH = state == State.LISTENING ? R * 0.42f : R * 0.26f;
        RectF el = new RectF(cx - R - eW, cy - eH, cx - R + eW, cy + eH);
        RectF er = new RectF(cx + R - eW, cy - eH, cx + R + eW, cy + eH);
        paint.setStyle(Paint.Style.FILL); paint.setColor(headFill);
        canvas.drawOval(el, paint); canvas.drawOval(er, paint);
        paint.setStyle(Paint.Style.STROKE); paint.setColor(headEdge); paint.setStrokeWidth(2f);
        canvas.drawOval(el, paint); canvas.drawOval(er, paint);

        // Eyes
        float ex1 = cx - R * 0.36f, ex2 = cx + R * 0.36f;
        float ey  = cy - R * 0.18f;
        float eW2 = R * 0.24f;
        float eH2 = blinking ? 2f : R * 0.30f;
        paint.setStyle(Paint.Style.FILL); paint.setColor(Color.WHITE);
        canvas.drawOval(new RectF(ex1 - eW2, ey - eH2, ex1 + eW2, ey + eH2), paint);
        canvas.drawOval(new RectF(ex2 - eW2, ey - eH2, ex2 + eW2, ey + eH2), paint);

        if (!blinking) {
            float pR = R * 0.10f;
            float pOx = state == State.THINKING ? pR * 1.4f : 0;
            float pOy = state == State.THINKING ? -pR * 1.4f : 0;
            paint.setColor(0xFF220044);
            canvas.drawCircle(ex1 + pOx, ey + pOy, pR, paint);
            canvas.drawCircle(ex2 + pOx, ey + pOy, pR, paint);
            paint.setColor(Color.WHITE);
            canvas.drawCircle(ex1 + pOx + pR * 0.3f, ey + pOy - pR * 0.3f, pR * 0.35f, paint);
            canvas.drawCircle(ex2 + pOx + pR * 0.3f, ey + pOy - pR * 0.3f, pR * 0.35f, paint);
        }

        // Eyebrows
        paint.setStyle(Paint.Style.STROKE);
        paint.setColor(0xFFc084fc);
        paint.setStrokeWidth(2.5f);
        paint.setStrokeCap(Paint.Cap.ROUND);
        float bY = ey - eH2 - R * 0.1f;
        if (state == State.LISTENING) {
            drawBrow(canvas, ex1, bY, eW2, -R * 0.14f);
            drawBrow(canvas, ex2, bY, eW2, -R * 0.14f);
        } else if (state == State.THINKING) {
            canvas.drawLine(ex1 - eW2, bY, ex1 + eW2, bY, paint);
            canvas.drawLine(ex2 - eW2, bY - R * 0.12f, ex2 + eW2, bY, paint);
        } else {
            drawBrow(canvas, ex1, bY, eW2, -R * 0.09f);
            drawBrow(canvas, ex2, bY, eW2, -R * 0.09f);
        }

        // Mouth
        float mY = cy + R * 0.46f;
        float mW = R * 0.44f;
        paint.setStyle(Paint.Style.STROKE);
        paint.setColor(0xFFe0a0ff);
        paint.setStrokeWidth(2.5f);
        paint.setStrokeCap(Paint.Cap.ROUND);

        if (state == State.SPEAKING) {
            float open = (float) Math.abs(Math.sin(frame * 0.18)) * R * 0.30f;
            Path p = new Path();
            p.moveTo(cx - mW, mY);
            p.quadTo(cx, mY + open, cx + mW, mY);
            paint.setStyle(Paint.Style.STROKE); canvas.drawPath(p, paint);
            if (open > R * 0.05f) {
                paint.setStyle(Paint.Style.FILL); paint.setColor(0xFF440022);
                canvas.drawPath(p, paint);
            }
        } else if (state == State.THINKING) {
            canvas.drawLine(cx - mW * 0.6f, mY, cx + mW * 0.6f, mY, paint);
        } else if (state == State.LISTENING) {
            float ow = R * 0.16f;
            canvas.drawOval(new RectF(cx - ow, mY - ow * 0.8f, cx + ow, mY + ow * 0.8f), paint);
        } else {
            Path smile = new Path();
            smile.moveTo(cx - mW, mY);
            smile.quadTo(cx, mY + R * 0.26f, cx + mW, mY);
            canvas.drawPath(smile, paint);
        }

        // Rosy cheeks
        if (state == State.IDLE || state == State.SPEAKING) {
            paint.setStyle(Paint.Style.FILL);
            paint.setColor(0x22ff64c8);
            canvas.drawOval(new RectF(cx - R * 0.88f, cy + R * 0.08f, cx - R * 0.38f, cy + R * 0.36f), paint);
            canvas.drawOval(new RectF(cx + R * 0.38f, cy + R * 0.08f, cx + R * 0.88f, cy + R * 0.36f), paint);
        }

        // Sound waves
        if (state == State.SPEAKING) {
            for (int i = 1; i <= 3; i++) {
                float wr = R + i * R * 0.38f + (float) Math.sin(frame * 0.2 + i) * 3f;
                int a = 100 - i * 28;
                paint.setStyle(Paint.Style.STROKE);
                paint.setColor((a << 24) | 0xC084FC);
                paint.setStrokeWidth(1.5f);
                canvas.drawArc(new RectF(cx - wr, cy - wr, cx + wr, cy + wr), -35, 70, false, paint);
            }
        }

        // Think bubbles
        if (state == State.THINKING) {
            for (int i = 0; i < 3; i++) {
                float br = 3 + i * 3;
                float bx = cx + R * 0.75f + i * R * 0.32f;
                float by = cy - R * 0.65f - i * R * 0.38f;
                paint.setStyle(Paint.Style.STROKE);
                paint.setColor(0x887c3aed);
                paint.setStrokeWidth(1.5f);
                canvas.drawCircle(bx, by, br, paint);
            }
        }
    }

    private void drawBrow(Canvas c, float bx, float by, float w, float dip) {
        Path p = new Path();
        p.moveTo(bx - w, by - dip * 0.5f);
        p.quadTo(bx, by + dip, bx + w, by - dip * 0.5f);
        c.drawPath(p, paint);
    }

    @Override
    protected void onDetachedFromWindow() {
        super.onDetachedFromWindow();
        handler.removeCallbacks(animRunnable);
    }
}
