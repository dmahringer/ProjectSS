// document.getElementById('change-username').addEventListener('click', function() {
//     var usernameElement = document.getElementById('username');
//     var isEditable = usernameElement.isContentEditable;
//     // Toggle the 'contenteditable' attribute
//     usernameElement.contentEditable = !isEditable;
//     // Change the text of the 'change-username' element based on the current state
//     this.textContent = isEditable ? 'Change Username' : 'Save Username';
// });


document.getElementById('change-username').addEventListener('click', function() {
    var usernameElement = document.getElementById('username');
    var isEditable = usernameElement.isContentEditable;
    // Toggle the 'contenteditable' attribute
    usernameElement.contentEditable = !isEditable;
    // Change the text of the 'change-username' element based on the current state
    this.textContent = isEditable ? 'Change Username' : 'Save Username';

    if (isEditable) { // Only send the AJAX request if the username is being saved
        // The username has been edited and the "Save Username" button has been clicked
        // Send an AJAX request to the server to update the username
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_username.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    alert('Username updated successfully');
                } else {
                    alert('Error: ' + response.error);
                    // Revert the username to its original value
                    usernameElement.textContent = response.originalUsername;
                }
            }
        };
        var newUsername = usernameElement.textContent;
        xhr.send('username=' + encodeURIComponent(newUsername));
    }
});