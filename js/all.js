

document.querySelectorAll("input[type='text']").forEach(input => {
    input.addEventListener("input", function() {
        this.value = this.value.toUpperCase();
    });
});

  