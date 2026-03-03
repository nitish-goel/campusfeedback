</div> <!-- col-md-10 -->
</div> <!-- row -->
</div> <!-- container-fluid -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
function showToast(message, type = "success") {
    const toastId = "nt-toast-" + Date.now();

    const typeClass = {
        success: "nt-toast-success",
        warning: "nt-toast-warning",
        danger: "nt-toast-danger"
    }[type];

    const toastHTML = `
        <div id="${toastId}" class="nt-toast ${typeClass}">
            <div class="nt-toast-accent"></div>
            <div class="nt-toast-row">
                <div class="nt-toast-body">${message}</div>
                <button class="nt-toast-close" onclick="removeNtToast('${toastId}')">&times;</button>
            </div>
        </div>
    `;

    const container = document.getElementById("nt-toast-container");
    container.insertAdjacentHTML("beforeend", toastHTML);

    const toastEl = document.getElementById(toastId);
    requestAnimationFrame(() => toastEl.classList.add("nt-toast-show"));

    setTimeout(() => removeNtToast(toastId), 3200);
}

function removeNtToast(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
    // location.reload();
}


</script>
</html>