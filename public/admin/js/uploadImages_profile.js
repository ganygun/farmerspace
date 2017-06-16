    var selectedFile;
    var tempFile;
    var date = new Date();
    var year = date.getFullYear();
    var month = date.getMonth();
    
    $("#fileUpload").on("change", function(event) {
        selectedFile = event.target.files[0];
        if (tempFile == selectedFile.name) {}
        var file = selectedFile;
        // Create a root reference
        var storageRef = firebase.storage().ref();
        // Create the file metadata
        var metadata = {
            contentType: 'image/jpeg'
        };
        // Upload file and metadata to the object 'images/mountains.jpg'
        if ($("#RegistType").val() == '01') {
            alert('done!');
        var uploadTask = storageRef.child('/FarmerspacePicture/imgProfile/type01/'+ $("#UserID").val()).put(file, metadata);
        }
        else if ($("#RegistType").val() == '02' || $("#RegistType").val() == 'Writer') {
        var uploadTask = storageRef.child('/FarmerspacePicture/imgProfile/type02/'+ $("#UserID").val()).put(file, metadata);
        }
        else if ($("#RegistType").val() == '03') {
        var uploadTask = storageRef.child('/FarmerspacePicture/imgProfile/type03/'+ $("#UserID").val()).put(file, metadata);
        }
        else if ($("#RegistType").val() == '04') {
        var uploadTask = storageRef.child('/FarmerspacePicture/imgProfile/type04/'+ $("#UserID").val()).put(file, metadata);
        }
        else if ($("#RegistType").val() == '05' || $("#RegistType").val() == 'Admin') {
        var uploadTask = storageRef.child('/FarmerspacePicture/imgProfile/type05/'+ $("#UserID").val()).put(file, metadata);
        console.log('ss');
        }
        //var uploadTask = storageRef.put(selectedFile);
        // Listen for state changes, errors, and completion of the upload.
        uploadTask.on(firebase.storage.TaskEvent.STATE_CHANGED, // or 'state_changed'
            function(snapshot) {
                // Get task progress, including the number of bytes uploaded and the total number of bytes to be uploaded
                var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                $('.progress').css('display','block');
                var elem = document.getElementById("progress"); 
                console.log('Upload is ' + progress + '% done');
                elem.style.width = Math.floor(progress) + '%'; 
                elem.innerHTML = Math.floor(progress) * 1  + '%';
                
                switch (snapshot.state) {
                    case firebase.storage.TaskState.PAUSED: // or 'paused'
                        console.log('Upload is paused');
                        break;
                    case firebase.storage.TaskState.RUNNING: // or 'running'
                        console.log('Upload is running');
                        break;
                }
                if (progress == 100) {
                    setTimeout(noneProgress, 2000);
                }
            },
            function(error) {
                switch (error.code) {
                    case 'storage/unauthorized':
                        // User doesn't have permission to access the object
                        break;
                    case 'storage/canceled':
                        // User canceled the upload
                        break;
                    case 'storage/unknown':
                        // Unknown error occurred, inspect error.serverResponse
                        break;
                }
            },
            function() {
                // Upload completed successfully, now we can get the download URL
                var downloadURL = uploadTask.snapshot.downloadURL;
                console.log("Url to download", downloadURL);
                var Path = downloadURL;
                document.getElementById("PathFile").value = Path;
            });

            function noneProgress() {
                $('.progress').css('display','none');
            }   
        
    });
