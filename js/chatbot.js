/* chatbot.js — Sam Incendie
   Widget de questions/réponses. Répond aux questions courantes,
   qualifie la situation de l'utilisateur, et redirige vers un devis
   ou les kits PDF quand la réponse dépend du cas précis de l'établissement. */
(function () {
  "use strict";

  var LANG = (document.documentElement.lang || "fr").slice(0, 2);
  if (["fr", "en", "de", "ar"].indexOf(LANG) === -1) LANG = "fr";
  var RTL = document.documentElement.dir === "rtl";

  // Chemins relatifs : racine pour fr, "../" pour en/de/ar
  var ROOT = RTL || LANG !== "fr" ? "../" : "";
  var KIT_URL = "https://sam-securite-erp.systeme.io/b26ea1b4";
  var GUIDE_URL = ROOT + "produits.html";

  var STR = {
    fr: {
      title: "Sam Incendie",
      subtitle: "Réponse en quelques secondes",
      placeholder: "Posez votre question...",
      greeting: "Bonjour, je suis l'assistant de Sam Incendie. Je peux répondre aux questions courantes sur la conformité incendie, ou vous orienter vers un devis si votre cas demande une analyse précise.",
      chips: ["C'est quoi un ERP ?", "Combien coûte un audit ?", "Formation obligatoire ?", "Voir les kits PDF", "Parler à Sam"],
      fallback: "Cette question dépend de la configuration précise de votre établissement (type, catégorie, effectif). Je préfère vous mettre en relation avec Sam plutôt que de risquer une réponse approximative.",
      contactCta: "Demander un devis gratuit →",
      contactHref: "#contact",
      kitCta: "Voir le kit à 19 € →",
      humanCta: "Décrivez votre établissement dans le formulaire, Sam vous répond sous 24h.",
    },
    en: {
      title: "Sam Incendie",
      subtitle: "Reply in seconds",
      placeholder: "Ask a question...",
      greeting: "Hi, I'm the Sam Incendie assistant. I can answer common fire safety questions, or connect you with Sam if your case needs a precise review.",
      chips: ["What is an ERP building?", "How much does an audit cost?", "Is training mandatory?", "See the PDF kits", "Talk to Sam"],
      fallback: "This depends on your building's exact configuration (type, category, occupancy). I'd rather connect you with Sam than risk an approximate answer.",
      contactCta: "Request a free quote →",
      contactHref: "#contact",
      kitCta: "See the €19 kit →",
      humanCta: "Describe your building in the form, Sam replies within 24h.",
    },
    de: {
      title: "Sam Incendie",
      subtitle: "Antwort in Sekunden",
      placeholder: "Stellen Sie Ihre Frage...",
      greeting: "Hallo, ich bin der Assistent von Sam Incendie. Ich beantworte häufige Fragen zum Brandschutz oder verbinde Sie mit Sam, wenn Ihr Fall eine genaue Prüfung braucht.",
      chips: ["Was ist ein ERP-Gebäude?", "Was kostet ein Audit?", "Ist Schulung Pflicht?", "PDF-Kits ansehen", "Mit Sam sprechen"],
      fallback: "Das hängt von der genauen Konfiguration Ihres Gebäudes ab (Typ, Kategorie, Personenzahl). Ich verbinde Sie lieber mit Sam, statt eine ungenaue Antwort zu riskieren.",
      contactCta: "Kostenloses Angebot anfordern →",
      contactHref: "#contact",
      kitCta: "19-€-Kit ansehen →",
      humanCta: "Beschreiben Sie Ihr Gebäude im Formular, Sam antwortet innerhalb von 24h.",
    },
    ar: {
      title: "سام إنسندي",
      subtitle: "رد خلال ثوانٍ",
      placeholder: "اطرح سؤالك...",
      greeting: "مرحبًا، أنا مساعد سام إنسندي. يمكنني الإجابة عن الأسئلة الشائعة حول السلامة من الحرائق، أو توجيهك مباشرة إلى سام إذا كانت حالتك تتطلب تحليلاً دقيقًا.",
      chips: ["ما هي المنشأة المستقبلة للجمهور؟", "كم تكلفة التدقيق؟", "هل التدريب إلزامي؟", "عرض حقائب PDF", "التحدث مع سام"],
      fallback: "هذا يعتمد على تفاصيل منشأتك (النوع، الفئة، عدد الأشخاص). أفضّل توجيهك مباشرة إلى سام بدلاً من تقديم إجابة تقريبية.",
      contactCta: "طلب عرض سعر مجاني ←",
      contactHref: "#contact",
      kitCta: "عرض الحقيبة بـ 19 € ←",
      humanCta: "صف منشأتك في النموذج، سيرد سام خلال 24 ساعة.",
    },
  };
  var T = STR[LANG];

  // Base de réponses courtes, groupées par mots-clés (toutes langues confondues
  // pour la détection ; réponse rendue dans la langue de la page).
  var FAQ = [
    {
      kw: ["erp", "établissement recevant", "public building", "gebäude", "منشأة"],
      a: {
        fr: "Un ERP (Établissement Recevant du Public) est tout bâtiment accueillant des personnes extérieures : hôtel, restaurant, école, commerce, clinique, salle de sport. Le classement dépend du type d'activité et du nombre de personnes accueillies (5 catégories). Chaque catégorie a ses propres obligations de sécurité incendie.",
        en: "An ERP is any building open to the public: hotel, restaurant, school, shop, clinic, gym. Classification depends on the activity type and the number of people it can hold (5 categories), each with its own fire safety obligations.",
        de: "Ein ERP ist jedes öffentlich zugängliche Gebäude: Hotel, Restaurant, Schule, Geschäft, Klinik, Fitnessstudio. Die Einstufung hängt von Tätigkeitsart und Personenzahl ab (5 Kategorien), jede mit eigenen Brandschutzpflichten.",
        ar: "المنشأة المستقبلة للجمهور هي أي مبنى يستقبل أشخاصًا من خارجه: فندق، مطعم، مدرسة، متجر، عيادة، صالة رياضية. يعتمد التصنيف على نوع النشاط وعدد الأشخاص (5 فئات)، ولكل فئة التزاماتها الخاصة.",
      },
    },
    {
      kw: ["prix audit", "coût audit", "tarif audit", "audit cost", "audit price", "audit kosten", "تكلفة التدقيق", "كم تكلفة"],
      a: {
        fr: "Le prix d'un audit dépend de la surface, de la complexité et de la distance d'intervention — il n'y a pas de tarif unique honnête à donner sans voir votre dossier. Le premier échange téléphonique est gratuit et Sam vous donne un prix ferme sous 24h.",
        en: "Audit pricing depends on surface area, complexity, and travel distance — there's no honest flat rate without seeing your case. The first call is free, and Sam gives you a firm price within 24h.",
        de: "Der Preis eines Audits hängt von Fläche, Komplexität und Entfernung ab — ohne Ihren Fall zu kennen, gibt es keinen ehrlichen Pauschalpreis. Das erste Gespräch ist kostenlos, Sam nennt Ihnen einen Festpreis innerhalb von 24h.",
        ar: "تعتمد تكلفة التدقيق على المساحة والتعقيد ومسافة التدخل — لا يوجد سعر ثابت صادق دون الاطلاع على حالتك. المكالمة الأولى مجانية ويقدم لك سام سعرًا نهائيًا خلال 24 ساعة.",
      },
    },
    {
      kw: ["formation obligatoire", "formation epi", "mandatory training", "schulung pflicht", "التدريب إلزامي"],
      a: {
        fr: "Oui. L'article R.4227-28 du Code du travail impose à tout employeur de former les salariés désignés équipiers de première intervention (EPI), et d'organiser au minimum deux exercices d'évacuation par an. C'est vérifié en priorité par la commission de sécurité.",
        en: "Yes. Article R.4227-28 of the French Labour Code requires every employer to train designated first-response staff and run at least two evacuation drills per year — one of the first things the safety commission checks.",
        de: "Ja. Artikel R.4227-28 des französischen Arbeitsgesetzbuchs verpflichtet jeden Arbeitgeber, benannte Ersteinsatzkräfte zu schulen und mindestens zwei Evakuierungsübungen pro Jahr durchzuführen — einer der ersten Prüfpunkte der Sicherheitskommission.",
        ar: "نعم. تفرض المادة R.4227-28 من قانون العمل الفرنسي على كل صاحب عمل تدريب موظفين معينين كفرق تدخل أول، وتنظيم تمرينين للإخلاء سنويًا على الأقل — وهذا أول ما تتحقق منه لجنة السلامة.",
      },
    },
    {
      kw: ["kit", "pdf", "checklist", "حقيبة"],
      a: {
        fr: "Deux kits sont disponibles en accès immédiat : le kit ERP 5e catégorie à 19 € (registre, consignes, checklist 40 points) et le guide complet à 47 € pour toutes catégories. Idéal si vous voulez avancer seul avant un audit.",
        en: "Two kits are available for instant download: the 5th-category kit at €19 (register, instructions, 40-point checklist) and the full guide at €47 for all categories. Good if you want to make progress on your own before an audit.",
        de: "Zwei Kits stehen sofort zum Download bereit: das Kit für die 5. Kategorie zu 19 € (Register, Anweisungen, 40-Punkte-Checkliste) und der komplette Leitfaden zu 47 € für alle Kategorien.",
        ar: "تتوفر حقيبتان للتحميل الفوري: حقيبة الفئة الخامسة بـ 19 € (سجل، تعليمات، قائمة تحقق من 40 نقطة) والدليل الشامل بـ 47 € لكل الفئات.",
      },
      cta: "kit",
    },
    {
      kw: ["sanction", "amende", "fermeture", "penalty", "fine", "strafe", "عقوبات", "غرامات"],
      a: {
        fr: "Les sanctions vont de la fermeture administrative immédiate à des poursuites pénales (jusqu'à 5 ans de prison et 75 000 € d'amende en cas d'homicide involontaire), en passant par la responsabilité civile de l'exploitant. La mise en conformité préventive coûte toujours moins cher que ces conséquences.",
        en: "Sanctions range from immediate administrative closure to criminal charges (up to 5 years in prison and €75,000 in fines in case of involuntary manslaughter), plus civil liability for the operator. Preventive compliance always costs less than these consequences.",
        de: "Die Sanktionen reichen von sofortiger behördlicher Schließung bis zu strafrechtlicher Verfolgung (bis zu 5 Jahre Haft und 75.000 € Geldstrafe bei fahrlässiger Tötung), zusätzlich zur zivilrechtlichen Haftung. Präventive Konformität ist immer günstiger als diese Folgen.",
        ar: "تتراوح العقوبات من الإغلاق الإداري الفوري إلى الملاحقة الجنائية (حتى 5 سنوات سجن وغرامة 75,000 يورو في حال وفاة غير متعمدة)، إضافة إلى المسؤولية المدنية. الامتثال الوقائي دائمًا أقل تكلفة من هذه العواقب.",
      },
    },
  ];

  function match(text) {
    var t = text.toLowerCase();
    for (var i = 0; i < FAQ.length; i++) {
      for (var j = 0; j < FAQ[i].kw.length; j++) {
        if (t.indexOf(FAQ[i].kw[j].toLowerCase()) !== -1) return FAQ[i];
      }
    }
    return null;
  }

  function el(tag, cls, html) {
    var e = document.createElement(tag);
    if (cls) e.className = cls;
    if (html !== undefined) e.innerHTML = html;
    return e;
  }

  function build() {
    var launcher = el("button", "", "");
    launcher.id = "sic-launcher";
    launcher.setAttribute("aria-label", T.title);
    launcher.innerHTML =
      '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>' +
      '<span class="sic-badge">1</span>';

    var panel = el("div", "");
    panel.id = "sic-panel";
    panel.setAttribute("dir", RTL ? "rtl" : "ltr");
    panel.innerHTML =
      '<div id="sic-header">' +
      '<div class="sic-avatar">S</div>' +
      '<div><p class="sic-title">' + T.title + "</p><p class=\"sic-sub\">" + T.subtitle + "</p></div>" +
      '<button id="sic-close" aria-label="close">✕</button>' +
      "</div>" +
      '<div id="sic-body"></div>' +
      '<div id="sic-footer">' +
      '<input id="sic-input" type="text" placeholder="' + T.placeholder + '" />' +
      '<button id="sic-send" aria-label="send"><svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22,2 15,22 11,13 2,9"/></svg></button>' +
      "</div>";

    document.body.appendChild(launcher);
    document.body.appendChild(panel);

    var body = panel.querySelector("#sic-body");
    var input = panel.querySelector("#sic-input");

    function addMsg(text, who) {
      var m = el("div", "sic-msg sic-msg-" + who, text);
      body.appendChild(m);
      body.scrollTop = body.scrollHeight;
      return m;
    }

    function addChips(list) {
      var wrap = el("div", "sic-quick-replies");
      list.forEach(function (label) {
        var chip = el("button", "sic-chip", label);
        chip.addEventListener("click", function () {
          handleUser(label);
        });
        wrap.appendChild(chip);
      });
      body.appendChild(wrap);
      body.scrollTop = body.scrollHeight;
    }

    function addCta(label, href) {
      var m = el("div", "sic-msg sic-msg-bot", "");
      var a = el("a", "", label);
      a.href = href;
      a.style.color = "#C0392B";
      a.style.fontWeight = "700";
      a.style.textDecoration = "none";
      m.appendChild(a);
      body.appendChild(m);
      body.scrollTop = body.scrollHeight;
    }

    function handleUser(text) {
      addMsg(text, "user");

      if (/parler|talk to sam|mit sam|التحدث/i.test(text)) {
        addMsg(T.humanCta, "bot");
        addCta(T.contactCta, T.contactHref);
        return;
      }
      if (/kit|pdf|حقيبة/i.test(text)) {
        var kitEntry = FAQ.filter(function (f) { return f.cta === "kit"; })[0];
        addMsg(kitEntry.a[LANG], "bot");
        addCta(T.kitCta, KIT_URL);
        return;
      }

      var found = match(text);
      if (found) {
        addMsg(found.a[LANG], "bot");
        if (found.cta === "kit") addCta(T.kitCta, KIT_URL);
      } else {
        addMsg(T.fallback, "bot");
        addCta(T.contactCta, T.contactHref);
      }
    }

    // Ouverture / fermeture
    launcher.addEventListener("click", function () {
      panel.classList.toggle("sic-open");
      launcher.querySelector(".sic-badge").style.display = "none";
      if (panel.classList.contains("sic-open") && !body.hasChildNodes()) {
        addMsg(T.greeting, "bot");
        addChips(T.chips);
      }
    });
    panel.querySelector("#sic-close").addEventListener("click", function () {
      panel.classList.remove("sic-open");
    });

    // Envoi
    function submit() {
      var v = input.value.trim();
      if (!v) return;
      input.value = "";
      handleUser(v);
    }
    panel.querySelector("#sic-send").addEventListener("click", submit);
    input.addEventListener("keydown", function (e) {
      if (e.key === "Enter") submit();
    });
  }

  if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", build);
  } else {
    build();
  }
})();
