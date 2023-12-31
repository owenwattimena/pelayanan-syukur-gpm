// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyBWCXlRXEfUve5EeSiGXC5Y6xNna8BaESQ"
    , authDomain: "pelayanan-syukur-gpm.firebaseapp.com"
    , projectId: "pelayanan-syukur-gpm"
    , storageBucket: "pelayanan-syukur-gpm.appspot.com"
    , messagingSenderId: "919821735283"
    , appId: "1:919821735283:web:805540052993253632e106"
    , measurementId: "G-NEKRCJTRCV"
});

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
