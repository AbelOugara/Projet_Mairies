
    <head>
        <link rel="stylesheet" href="css_footer.css">
    </head>
    <body>
        <footer>
            <p> 
                <label onclick="toggleVisibility()"> &copy; </label>2024 DevisseInformatique 
                <div id="contenu" style="display: none;">réalisé par Abel OUGARA et Aramis MOHAMED</div>
                <script>
                    function toggleVisibility() {
                        const div = document.getElementById('contenu');
                        div.style.display = div.style.display === "none" ? "block" : "none";
                    }
                </script>
            </p>
        </footer>
    </body>