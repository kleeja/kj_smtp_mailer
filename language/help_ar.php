<?php
//
// kj_smtp_mailer, its guide on the help page of the control panel
// Arabic, see help_en.php for how the words are named
//
// A word missing here is shown in English.
// Names in <strong> are written as the control panel shows them in Arabic,
// the words of Kleeja are in lang/ar/, the words of the plugin in kj_smtp_mailer_translations() of functions.php.
// The errors of the mail server are in English, so they are quoted in English, in the answers:
// a tag in a question breaks its button into columns.
// A <code> that begins or ends with a symbol takes dir="ltr", or the symbol shows on the wrong side.
//

return [
    'KJ_SMTP_MAILER_HELP_TITLE' => 'إرسال البريد SMTP',
    'KJ_SMTP_MAILER_HELP_INTRO' =>
        'أرسل بريد موقعك عبر خادم SMTP خاص بك بدلًا من دالة البريد في PHP. تسجّل كل رسالة الدخول إلى صندوق بريد حقيقي، فتصل رسائل استعادة كلمة المرور وردودك إلى البريد الوارد لا إلى مجلد البريد المزعج، ويعمل البريد حتى على الاستضافات التي تحجب دالة البريد في PHP.',

    //
    // what the plugin does
    //
    'KJ_SMTP_MAILER_HELP_FEATURE_1' =>
        'ترسل كل رسائل كليجا: استعادة كلمة المرور، وردودك من صفحتي <strong>رسائل</strong> و<strong>تبليغات</strong>، والتنبيهات بالرسائل والتبليغات الجديدة.',
    'KJ_SMTP_MAILER_HELP_FEATURE_2' =>
        'يملأ تبويب <strong>إعدادات جاهزة</strong> إعدادات خادم Hostinger أو Gmail بنقرة واحدة.',
    'KJ_SMTP_MAILER_HELP_FEATURE_3' =>
        'يوضّح تبويب <strong>الحالة والاختبار</strong> هل ترسل الإضافة بريد الموقع، ويعرض ما ينقص إعداداتها، ويرسل رسالة تجريبية. وإذا رفض الخادم الرسالة التجريبية، عرضت الصفحة السبب الذي ذكره الخادم.',
    'KJ_SMTP_MAILER_HELP_FEATURE_4' =>
        'لا تتدخّل الإضافة في البريد حتى تكتمل إعداداتها، وتواصل كليجا إرساله بدالة البريد في PHP.',
    'KJ_SMTP_MAILER_HELP_FEATURE_5' =>
        'تحمل التنبيهات بالرسائل والتبليغات الجديدة بريد الزائر. ترسلها الإضافة من بريدك أنت، وتجعل بريد الزائر عنوان الرد، فتردّ على الزائر مباشرة.',
    'KJ_SMTP_MAILER_HELP_FEATURE_6' =>
        'تحتفظ الرسائل بتصميم بريد كليجا، مع نسخة نصية لبرامج البريد التي لا تعرض HTML.',

    //
    // how to use it
    //
    'KJ_SMTP_MAILER_HELP_STEP_TITLE' => 'إعداد إرسال البريد SMTP',
    'KJ_SMTP_MAILER_HELP_STEP_1' =>
        'أنشئ صندوق بريد للموقع لدى استضافتك أو مزوّد بريدك، مثل <code>noreply@yourdomain.com</code>، ودوّن خادم SMTP والمنفذ واسم المستخدم وكلمة المرور.',
    'KJ_SMTP_MAILER_HELP_STEP_2' =>
        'إذا كان مزوّدك في تبويب <strong>إعدادات جاهزة</strong> من صفحة <strong>إرسال البريد SMTP</strong>، فاضغط <strong>استخدم هذه الإعدادات</strong> في بطاقته.',
    'KJ_SMTP_MAILER_HELP_STEP_3' =>
        'افتح <strong>إعدادات</strong> ثم <strong>إرسال البريد SMTP</strong>. املأ الحقول التي ما زالت فارغة كما توضّح القائمة أدناه، ثم اضغط <strong>تحديث الإعدادات</strong>.',
    'KJ_SMTP_MAILER_HELP_STEP_4' =>
        'في تبويب <strong>الحالة والاختبار</strong>، تأكد من أن الصفحة تقول إن بريد الموقع يُرسل عبر خادم SMTP الخاص بك.',
    'KJ_SMTP_MAILER_HELP_STEP_5' =>
        'اكتب بريدك في <strong>الإرسال إلى</strong>، واضغط <strong>إرسال تجريبي</strong>، ثم تأكد من وصول الرسالة إلى بريدك الوارد.',

    //
    // the settings, on the SMTP Mailer tab of the settings page
    //
    'KJ_SMTP_MAILER_HELP_SETTING_TITLE' => 'الإعدادات',
    'KJ_SMTP_MAILER_HELP_SETTING_1' =>
        '<strong>بريد المُرسِل</strong> و<strong>اسم المُرسِل</strong>: البريد والاسم اللذان تُرسل منهما رسائلك. لا تقبل أغلب الخوادم إلا بريد الصندوق الذي يسجّل الدخول، أو بريدًا من النطاق نفسه.',
    'KJ_SMTP_MAILER_HELP_SETTING_2' =>
        '<strong>الإرسال دائمًا من هذا البريد</strong> و<strong>الإرسال دائمًا بهذا الاسم</strong>: عند <strong>نعم</strong> تُرسل كل رسالة من البريد والاسم أعلاه. وعند <strong>لا</strong> تُرسل الرسالة من البريد والاسم اللذين تعطيهما كليجا، وهما بريد الزائر واسمه في التنبيهات بالرسائل والتبليغات الجديدة.',
    'KJ_SMTP_MAILER_HELP_SETTING_3' => '<strong>مضيف SMTP</strong>: عنوان خادم البريد، مثل <code>smtp.gmail.com</code>.',
    'KJ_SMTP_MAILER_HELP_SETTING_4' =>
        '<strong>منفذ SMTP</strong> و<strong>تشفير SMTP</strong>: استخدم المنفذ 587 مع <strong>TLS</strong>، أو المنفذ 465 مع <strong>SSL</strong>. والمنفذ الفارغ يعني 465 مع <strong>SSL</strong> و587 مع غيره. ويبقى الاتصال مشفّرًا مع <strong>بدون</strong> إذا كان الخادم يدعم التشفير.',
    'KJ_SMTP_MAILER_HELP_SETTING_5' =>
        '<strong>مصادقة SMTP</strong>: أبقها على <strong>نعم</strong>، إلا إذا كان خادمك يقبل بريد موقعك دون تسجيل الدخول.',
    'KJ_SMTP_MAILER_HELP_SETTING_6' =>
        '<strong>اسم مستخدم SMTP</strong> و<strong>كلمة مرور SMTP</strong>: بيانات الدخول إلى صندوق البريد. واسم المستخدم في الغالب هو عنوان البريد كاملًا.',

    //
    // common questions
    //
    'KJ_SMTP_MAILER_HELP_FAQ_Q_1' => 'يقول تبويب الحالة والاختبار إن بريد الموقع ما زال يُرسل بدالة البريد في PHP، لماذا؟',
    'KJ_SMTP_MAILER_HELP_FAQ_A_1' =>
        'لم تكتمل الإعدادات بعد، والصفحة تعرض ما ينقصها: <strong>مضيف SMTP</strong>، أو <strong>بريد المُرسِل</strong>، أو <strong>اسم مستخدم SMTP</strong> و<strong>كلمة مرور SMTP</strong> حين تكون <strong>مصادقة SMTP</strong> مفعّلة. وإذا قالت إن مكتبة PHPMailer غير موجودة، فثبّت الإضافة من جديد من أرشيف إصدارها، إذ لا تتضمّن نسخة الشيفرة المصدرية للإضافة هذه المكتبة.',
    'KJ_SMTP_MAILER_HELP_FAQ_Q_2' => 'تفشل الرسالة التجريبية لأن الخادم رفض تسجيل الدخول، ماذا أراجع؟',
    'KJ_SMTP_MAILER_HELP_FAQ_A_2' =>
        'تعرض الصفحة الخطأ <code>Could not authenticate</code>، أي أن الخادم رفض اسم المستخدم أو كلمة المرور. اكتب عنوان البريد كاملًا في <strong>اسم مستخدم SMTP</strong>، وأعد كتابة كلمة المرور. ولا يقبل Gmail هنا كلمة مرور الحساب: فعّل التحقق بخطوتين في حساب Google، وأنشئ «كلمة مرور للتطبيقات»، واكتبها في <strong>كلمة مرور SMTP</strong>.',
    'KJ_SMTP_MAILER_HELP_FAQ_Q_3' => 'تفشل الرسالة التجريبية لأن كليجا لم تصل إلى الخادم، ماذا أراجع؟',
    'KJ_SMTP_MAILER_HELP_FAQ_A_3' =>
        'تعرض الصفحة الخطأ <code>Could not connect to SMTP host</code>، أي أن كليجا لم تستطع الوصول إلى الخادم. راجع <strong>مضيف SMTP</strong>، وتأكد من توافق <strong>منفذ SMTP</strong> و<strong>تشفير SMTP</strong>: المنفذ 587 مع <strong>TLS</strong>، والمنفذ 465 مع <strong>SSL</strong>. وكثير من الاستضافات تحجب منافذ البريد الصادر، فجرّب المنفذ الآخر، أو اطلب من استضافتك فتحه. وقد يجعل المنفذ المحجوب الرسالة التجريبية تنتظر حتى 30 ثانية قبل أن تفشل.',
    'KJ_SMTP_MAILER_HELP_FAQ_Q_4' => 'قبل الخادم الرسالة التجريبية لكنها لم تصل، لماذا؟',
    'KJ_SMTP_MAILER_HELP_FAQ_A_4' =>
        'ابحث عنها أولًا في مجلد البريد المزعج. ثم تأكد من أن <strong>بريد المُرسِل</strong> هو بريد الصندوق الذي يسجّل الدخول، أو بريد من النطاق نفسه، ومن أن للنطاق سجلّي SPF وDKIM. وتشرح استضافتك أو مزوّد بريدك طريقة إضافتهما.',
    'KJ_SMTP_MAILER_HELP_FAQ_Q_5' => 'أين أعرف سبب عدم إرسال رسالة من رسائل الموقع؟',
    'KJ_SMTP_MAILER_HELP_FAQ_A_5' =>
        'في سجل أخطاء PHP على خادمك، في سطر يبدأ بـ <code dir="ltr">kj_smtp_mailer:</code>. فيه السبب الذي ذكره الخادم وجزء من عنوان البريد. ولا يُكتب فيه محتوى الرسالة، لأنه قد يحتوي على كلمة مرور جديدة.',

    //
    // beside the guide
    //
    'KJ_SMTP_MAILER_HELP_TIP_1' =>
        'أرسل البريد من صندوق مخصّص للموقع، مثل <code>noreply@yourdomain.com</code>، لا من بريدك الشخصي.',
    'KJ_SMTP_MAILER_HELP_TIP_2' => 'بعد تغيير أي إعداد، أرسل رسالة تجريبية من جديد.',
    'KJ_SMTP_MAILER_HELP_TIP_3' =>
        'حسابات البريد المجانية، مثل Gmail، ترسل عددًا محدودًا من الرسائل كل يوم. وللموقع الكثير الزوار، استخدم بريد استضافتك أو خدمة لإرسال البريد.',

    'KJ_SMTP_MAILER_HELP_WARNING_1' =>
        'تستبدل الإعدادات الجاهزة <strong>مضيف SMTP</strong> و<strong>منفذ SMTP</strong> و<strong>تشفير SMTP</strong> و<strong>مصادقة SMTP</strong>. أما بريد المُرسِل واسم المستخدم وكلمة المرور فتبقى كما هي.',
    'KJ_SMTP_MAILER_HELP_WARNING_2' =>
        'تحفظ كليجا <strong>كلمة مرور SMTP</strong> في قاعدة بياناتها كما هي، فاستخدم كلمة مرور لا يشاركها أي حساب آخر.',
    'KJ_SMTP_MAILER_HELP_WARNING_3' =>
        'لا تجعل <strong>الإرسال دائمًا من هذا البريد</strong> على <strong>لا</strong> إلا إذا كان خادمك يقبل أي مُرسِل، وإلا فستُرفض التنبيهات بالرسائل والتبليغات الجديدة أو تنتهي في البريد المزعج.',
    'KJ_SMTP_MAILER_HELP_WARNING_4' =>
        'لا يستطيع فتح صفحة <strong>إرسال البريد SMTP</strong> إلا المؤسس، لأنها ترسل البريد وتغيّر إعدادات الخادم.',

    //
    // in the guide of the settings, whose page has the tab of the plugin
    //
    'KJ_SMTP_MAILER_HELP_NOTE' =>
        'تبويب <strong>إرسال البريد SMTP</strong> تابع لإضافة <strong>إرسال البريد SMTP</strong>، التي ترسل بريد الموقع عبر خادم البريد الخاص بك. <a href="#help-kj_smtp_mailer">اقرأ دليلها</a>.',
];
