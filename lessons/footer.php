</body>
<script>
    document.querySelector('.show-pass i').addEventListener('click', function () {
        let input = document.getElementById('pass');
        this.classList.toggle('fa-eye-slash')
        if (input.getAttribute('type') === 'password') {
            input.setAttribute('type', 'text');
            input.focus();
        } else {
            input.setAttribute('type', 'password');
            input.focus();
        }
    });
    let formLog = document.getElementById('login');
    let formRegister = document.getElementById('register');
    let toggles = document.querySelectorAll('.toggle');
    for (let btn of toggles) {
        btn.addEventListener('click', function (e) {
            e.preventDefault();
            formRegister.classList.toggle('hide');
            formLog.classList.toggle('hide');
        })
    };

</script>
</html>
