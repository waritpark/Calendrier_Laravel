
    <footer class="container-fluid bg-color-white">
        <div class="container height-60">
            <div class="d-flex justify-content-center height-60 font-family-roboto align-items-center color-black">
                <p class="mx-4 mb-0">Project Calendar</p>
                <span>|</span>
                <p class="mx-4 mb-0">Arthur <span class="text-uppercase"> Lafarge</span></p>
                <span>|</span>
                <p class="mx-4 mb-0">© 2021</p>
            </div>
        </div>
    </footer>
    <script>
        // Vérification de l'égalité des mots de passe
        function checkpass() {
            var pass = document.getElementById('password').value;
            var pass2 = document.getElementById('password2').value;
            var egalpass = document.getElementById("egalpass");
            if (pass !== pass2) {
                egalpass.classList.remove('alert-success','alert-secondary');
                egalpass.classList.add('alert','alert-danger');
                egalpass.innerHTML='Les mots de passe ne sont pas identiques.';
            } else if (pass === pass2) {
                egalpass.classList.remove('alert-danger','alert-secondary');
                egalpass.classList.add('alert','alert-success');
                egalpass.innerHTML='Les mots de passe sont identiques.';
            }
        };

        // désafficher les modales
        function removeSuccess() {
            document.getElementById("modal-success-event").classList.remove("d-block");
        }

        // Afficher le formulaire d'ajout d'event
        function afficherForm() {
            document.getElementById("container-form-ajout-event").classList.toggle("d-none");
        }

        // Afficher l'input password2 pour changer de mdp
        function afficherPass() {
            document.getElementById("btnPass").classList.add("d-none");
            document.getElementById("btnCheck").classList.toggle("d-none");
            document.getElementById('pass1').innerHTML ='<div class="">'+
                    '<label for="password" class="form-label">Nouveau mot de passe</label>'+
                    '<input type="password" autocomplete="off" class="form-control" onkeyup="logKey()" name="password" id="password">'+
                    '<div class="alert alert-secondary" id="passwordStrength">Jauge de fiabilité du mot de passe</div>'+
                '</div>';
            document.getElementById('pass2').innerHTML ='<div class="mb-3">'+
                    '<label for="password2" class="form-label">Répétez le nouveau mot de passe</label>'+
                    '<input type="password" autocomplete="off" onkeyup="checkpass()" class="form-control" name="password2" id="password2">'+
                    '<div class="alert alert-secondary" id="egalpass">Vérification de l\'égalité vos mots de passe</div>'+
                '</div>';
        }

        // Afficher l'input password2 pour changer de mdp
        function suppPass() {
            document.getElementById("btnCheck").classList.toggle("d-none");
            document.getElementById("btnPass").classList.remove("d-none");
            var pass1 = document.getElementById("pass1");
            var pass2 = document.getElementById("pass2");
            while (pass1.firstChild) {
                pass1.removeChild(pass1.firstChild);
            }
            while (pass2.firstChild) {
                pass2.removeChild(pass2.firstChild);
            }
        }


    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="{{ asset('javascript/strongMdp.js') }}"></script>
</body>
</html>