document.addEventListener("DOMContentLoaded", function() {
    const savedTheme = localStorage.getItem("theme");
    if (savedTheme) {
        document.body.className = savedTheme;
    }

    document.getElementById("themeSelector").addEventListener("change", function(event) {
        const theme = event.target.value;
        document.body.className = theme;
        localStorage.setItem("theme", theme);
    });
});
