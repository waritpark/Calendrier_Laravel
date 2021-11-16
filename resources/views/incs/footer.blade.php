
    </div>
    <footer class="container-fluid bg-secondary">
        <div class="container height-100">
            <div class="d-flex justify-content-around h-100 text-white font-family-roboto align-items-center">
                <p class="m-0">Projet Calendrier</p>
                <p class="m-0">Arthur <span class="text-uppercase text-blue"> Lafarge</span></p>
                <p class="m-0">© 2021</p>
            </div>
        </div>
    </footer>
    <script>
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
            document.getElementById("pass2").classList.remove("d-none");
            document.getElementById("pass1").classList.remove("d-none");
            document.getElementById("btnPass").classList.add("d-none");
            document.getElementById("passwordCompte").removeAttribute("disabled","");
        }

        // Afficher l'input password2 pour changer de mdp
        function suppPass() {
            document.getElementById("pass2").classList.add("d-none");
            document.getElementById("pass1").classList.add("d-none");
            document.getElementById("btnPass").classList.remove("d-none");
        }

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('javascript/strongMdp.js') }}"></script>
</body>
</html>