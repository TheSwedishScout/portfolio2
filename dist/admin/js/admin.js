document.addEventListener("DOMContentLoaded", e => {
    document
        .getElementById("addNewprojectForm")
        .addEventListener("submit", e => {
            e.preventDefault();
            var formData = new FormData(
                document.getElementById("addNewprojectForm")
            );
            // var odst = formData.getAll();
            debugger;
            axios
                .post("../api/projects.php", formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(res => {
                    debugger;
                });
        });
});
