

window.Echo.channel('notification-user-register')
    .listen('UserRegistered', (e) => {
        alert('ada notifikasi data baru masuk ni');
        console.log('User baru:', e);
    });
