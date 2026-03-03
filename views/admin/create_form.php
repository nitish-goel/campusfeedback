<?php include 'layout/header.php'; ?>
<?php include 'layout/sidebar.php'; ?>

<div class="container mt-4">
    <h2>Create Feedback Form</h2>

    <form id="createForm">
        <div class="mb-3">
            <label>Form Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Form</button>
    </form>

    <hr>

    <div id="fieldSection" style="display:none;">
        <h4>Add Fields</h4>

        <form id="addFieldForm">
            <input type="hidden" name="form_id" id="form_id">

            <div class="mb-3">
                <label class="form-label">Field Label</label>
                <input type="text" name="label" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Field Type</label>
                <select name="type" id="fieldType" class="form-select" required>
                    <option value="">Select Type</option>
                    <option value="text">Text</option>
                    <option value="textarea">Textarea</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                </select>
            </div>

            <div class="mb-3 d-none" id="optionsDiv">
                <label class="form-label">Options (comma separated)</label>
                <input type="text" name="options" class="form-control" 
                    placeholder="Good, Average, Poor">
                <small class="text-muted">
                    Required for Radio & Checkbox
                </small>
            </div>

            <button type="submit" class="btn btn-success">
                Add Field
            </button>
        </form>

        <div id="fieldList" class="mt-3"></div>
        <hr>
    </div>
</div>

<script>
document.getElementById("createForm").addEventListener("submit", function(e){
    e.preventDefault();

    fetch("../../api/create_form.php", {
        method: "POST",
        credentials: "include",   // IMPORTANT
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            title: this.title.value,
            description: this.description.value
        })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status){
            // alert("Form Created!");
            showToast("Form Created!", "success");
            document.getElementById("form_id").value = data.form_id;
            document.getElementById("fieldSection").style.display = "block";
        } else {
            // alert(data.message);
            showToast(data.message, "danger");
        }
    });
});

document.getElementById("addFieldForm").addEventListener("submit", function(e){
    e.preventDefault();

    fetch("../../api/add_field.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + localStorage.getItem("token")
        },
        body: JSON.stringify({
            form_id: this.form_id.value,
            label: this.label.value,
            type: this.type.value,
            options: this.options ? this.options.value : null
        })
    })
    .then(res => res.json())
    .then(data => {
        if(data.status){
            // alert("Field Added!");
            showToast("Field Added!", "success");
        }else{
            showToast(data.message, "danger");
        }
    });
});
</script>
<script>
const fieldType = document.getElementById("fieldType");
const optionsDiv = document.getElementById("optionsDiv");

fieldType.addEventListener("change", function() {
    if (this.value === "radio" || this.value === "checkbox") {
        optionsDiv.classList.remove("d-none");
    } else {
        optionsDiv.classList.add("d-none");
    }
});
</script>

<?php include 'layout/footer.php'; ?>