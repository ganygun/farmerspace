  var date = new Date();
  var year = date.getFullYear();
  var month = date.getMonth();
   // Initialize Firebase
  var config = {
      apiKey: "AIzaSyAoq09FApuwQfdw6VnFIuVKO1UoaAvL6SA",
      authDomain: "farmerspace-31fea.firebaseapp.com",
      databaseURL: "https://farmerspace-31fea.firebaseio.com",
      storageBucket: "farmerspace-31fea.appspot.com",
      messagingSenderId: "104709186666"
  };
  firebase.initializeApp(config);
  
  window.onload = function() {
      //Check File API support
      if (window.File && window.FileList && window.FileReader) {
          var filesInput = document.getElementById("fileUpload");
          filesInput.addEventListener("change", function(event) {
              var files = event.target.files; //FileList object
              var output = document.getElementById("result");
              for (var i = 0; i < files.length; i++) {
                  var file = files[i];
                  //Only pics
                  if (!file.type.match('image')) continue;
                  //Upload File[i]
                  // Create a root reference
                  var storageRef = firebase.storage().ref();
                  // Create the file metadata
                  var metadata = {
                      contentType: 'image/jpeg'
                  };
                  // Upload file and metadata to the object 'images/mountains.jpg'
                  var uploadTask = storageRef.child('/FarmerspacePicture/Product/'+$("#productKey").val()+'/Species/'+$("#speciesName").val()+'/' + file.name).put(file, metadata);
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
                          var picReader = new FileReader();
                          picReader.addEventListener("load", function(event) {
                              var picFile = event.target;
                              var row = document.createElement("div")
                              row.className = "row";
                              row.id = file.name;
                              row.style = "margin-bottom: 15px;"
                                  //output.insertBefore(row,null); 
                              var div = document.createElement("div");
                              div.className = "col-md-8";
                              div.innerHTML = "<img class='thumb-image img img-responsive center-block' style='width: 200px' src='" + picFile.result + "'" + "title='" + file.name + "'/>";
                              // output.insertBefore(div,null); 
                              var div2 = document.createElement("div");
                              div2.className = "col-md-4";
                              div2.innerHTML = "<input type='button' onclick='deleteOverviewPic(\"" + file.name + "\")' class='btn btn-danger center-block' value='Delete'  />";
                              //output.insertBefore(div2,null);  
                              var divHidden = document.createElement("div");
                              divHidden.innerHTML = "<input type='hidden' id='PathFile' name='PathFile[]' value='" + Path + "'/>";
                              row.appendChild(div);
                              row.appendChild(div2);
                              row.appendChild(divHidden);
                              output.insertBefore(row, null);
                          });
                          //Read the image
                          picReader.readAsDataURL(file);
                      });
              }
          });
      } else {
          console.log("Your browser does not support File API");
      }
  }
   function noneProgress() {
        $('.progress').css('display','none');
    }


  function deleteOverviewPic(parentDiv) {
      var storageRef = firebase.storage().ref();
      // Create a reference to the file to delete
      var pictureRef = storageRef.child('/FarmerspacePicture/Product/'+$("#productKey").val()+'/Species/'+$("#speciesName").val()+'/'+ parentDiv);
      // Delete the file
      pictureRef.delete().then(function() {
          // File deleted successfully
          var el = document.getElementById(parentDiv);
          el.parentNode.removeChild(el);
          document.getElementById("fileUpload").value = '';
      }).catch(function(error) {
          // Uh-oh, an error occurred!
      });
  }