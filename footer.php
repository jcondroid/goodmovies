<script src="./javascript/person.js"></script>
<script src="./javascript/movie.js"></script>
<script>
// This script helped with page loading. The reason for the conditional was to not load the page
// for the movie.php page because it was moving element around while the page was loading.
// The show_body also exists but there is a separate one for movie.js
    $(document).ready(function() {
        show_body(true);
    });
</script>
</body>

</html>