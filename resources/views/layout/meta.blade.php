<html lang="ar" dir="rtl" data-bs-theme="light">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="4000 Essential English Words">
    <meta name="author" content="Ali Ghasemi">
    <link rel="icon" href="img/icons8-abc-block-32.png">


    <link href="/bootstrap/bootstrap.min.css" rel="stylesheet">

    <link href="/css/style.css" rel="stylesheet">

    <script src="{{ asset('js/app.js') }}" defer></script>

<script>

    // DO NOT EDIT FILE
// THIS FILE IS BUILT WITH GULP
function spoken(){}
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Speech SDK for Voice to Text and Text to Voice
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
(_=>{
'use strict';
if (typeof window !== 'undefined') window.spoken = spoken;

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Setup Speech Regcognition
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
const recognition = new (
    window.SpeechRecognition       ||
    window.webkitSpeechRecognition ||
    Object
)();

recognition.interimResults = true;
recognition.lang           = navigator.language || 'en-US';

spoken.recognition = recognition;

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Get Voices for Text-to-Speech
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
spoken.voices = async e => {
    return new Promise( r => {
        let voices = speechSynthesis.getVoices();
        if (voices.length) r(voices);
        speechSynthesis.onvoiceschanged = e => r(speechSynthesis.getVoices());
    } );
};

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Invoike Synthetic Voices for Text-to-Speech
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
spoken.say = async ( text, voice='Alex' ) => {
    const speech = new SpeechSynthesisUtterance(text);
    const voices = await spoken.voices();
    const lang   = recognition.lang;

    // Select Voice with Default
    if (voice)
        speech.voice = (voices.filter( v => v.name == voice ) || voices)[0];
    else
        speech.voice = (voices.filter( v => v.lang == lang  ) || voices)[0];

    return new Promise( resolve => {
        speech.onend = async () => resolve(speech);
        speechSynthesis.speak(speech);
    } );
};

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Speech to Text - Listens to your voice and creates a transcription.
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
spoken.listen = async ( setup={} ) => {
    recognition.onstart    = spoken.listen.startcb;
    recognition.onend      = spoken.listen.endcb;
    recognition.onerror    = spoken.listen.errorcb;
    recognition.continuous = setup.continuous;

    return new Promise( ( resolve, reject ) => {
        recognition.onresult = async e => transcriptResults( e, resolve );

        try      { recognition.start() }
        catch(e) { reject(e) }
    } );
};

function transcriptResults( event, resolve ) {
    const results = event.results;
    const interim = [];

    // Results
    for (let i=0;i<results.length;i++) {
        // Interim Result
        interim.push(results[i][0].transcript);

        // Final Result
        if (results[i].isFinal)
            resolve( results[i][0].transcript, event );
    }

    spoken.listen.partialcb( interim.join(''), event );
    interim.length = 0;
}

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Easy Wait Command
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
spoken.delay = duration => {
    return new Promise( resolve => setTimeout( resolve, duration ) );
}

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Stop Speech to Text Voice Recognition
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
spoken.listen.stop = async e => {
    spoken.recognition.stop();
};

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Speech to Text - Transcription Events
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
spoken.listen.on = {
    partial : cb => spoken.listen.partialcb = cb
,   start   : cb => spoken.listen.startcb   = cb
,   end     : cb => spoken.listen.endcb     = cb
,   error   : cb => spoken.listen.errorcb   = cb
};

spoken.listen.partialcb = e => true;
spoken.listen.startcb   = e => true;
spoken.listen.endcb     = e => true;
spoken.listen.errorcb   = e => true;

// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
// Speech to Text is Available
// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
spoken.listen.available = e => !!recognition.start;

})();

</script>
</head>
