<?php
include_once('../includes/config.php');
session_start();
if (strlen($_SESSION['rid']) == 0) {
   header('location:../registrar/index.php');
}
// Get and validate email parameter
$email = isset($_GET['email']) ? filter_var($_GET['email'], FILTER_SANITIZE_EMAIL) : '';


?>
<!DOCTYPE html>
<html>

<head>
   <style>
      body {
         font-family: Arial, sans-serif;
         background-color: #f4f4f4;
         margin: 0;
         padding: 30px;
      }

      .container {
         display: flex;
         justify-content: center;
         align-items: center;
         height: 90vh;
         /* Full height of the viewport */
      }

      .wrapper {
         background-color: white;
         padding: 20px;
         /* Added padding for space around content */
         border-radius: 8px;
         border: 1px solid #ccc;
         /* Added border */
         box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
         width: 450px;
         /* Width of the form */
         min-height: 100px;
         /* Increased height for the wrapper */
         position: relative;
         /* Position relative for positioning close button */
      }

      .header {
         background-color: #343a40;
         color: white;
         /* Header text color */
         padding: 10px;
         /* Padding for header */
         margin: -20px -20px 10px -20px;
         /* Adjusted margins to attach to the container */
         text-align: left;
         /* Align text to the left */
         border-radius: 8px 8px 0 0;
         /* Rounded corners for top */
         padding-left: 30px;
         /* Add space before the text */
         font-size: 15px;
         /* Header font size */
         position: relative;
         /* Position relative to allow absolute positioning for the close button */
      }

      .close-button {
         position: absolute;
         /* Position absolute to place it in the header */
         top: 5px;
         right: 5px;
         background-color: transparent;
         /* Transparent background */
         border: none;
         /* No border */
         color: gray;
         /* White color for visibility */
         font-size: 24px;
         /* Font size for close icon */
         cursor: pointer;
         /* Pointer cursor on hover */
      }

      label {
         font-weight: bold;
      }

      input[type="text"],
      textarea {
         width: 95%;
         padding: 10px;
         border: 0px solid #ccc;
         /* Add a border to input fields */
         border-radius: 4px;
         color: black;
         /* Set text color to black */
         font-size: 15px;
         /* Increased font size for submit button */
         margin-top: 10px;
         /* Add margin for spacing */
      }

      textarea {
         height: 100px;
         /* Height for the textarea */
      }

      input[type="text"]::placeholder,
      textarea::placeholder {
         color: gray;
         /* Placeholder text color */
         opacity: 1;
         /* Make sure placeholder is fully visible */
      }

      input[type="submit"] {
         width: 100%;
         padding: 15px;
         /* Adjusted padding */
         background-color: #007bff;
         color: white;
         border: none;
         border-radius: 4px;
         cursor: pointer;
         margin-top: 1rem;
         font-size: 18px;
         /* Increased font size for submit button */
      }

      input[type="submit"]:hover {
         background-color: gray;
      }

      hr {
         border: 0;
         border-top: 1px solid rgba(0, 0, 0, .1);
      }
   </style>
</head>

<body>
   <div class="container">
      <div class="wrapper">
         <div class="header">
            New Message
            <button class="close-button" onclick="window.location.href='../admin/status-accepted.php';">&times;</button>
         </div>
         <form method="post" action="gmail.php">
            <select name="status" id="status" onchange="fillTemplate()" class="form-control" style="width: 95%; padding: 10px; margin: 10px 0; border: 1px solid #ccc; border-radius: 4px;">
               <option value="">Select Status</option>
               <option value="enrolled">Enrolled</option>
               <option value="rejected">Rejected</option>
            </select>
            <input type="text" name="email" id="email" value="<?= htmlspecialchars($email) ?>"
               placeholder="To" required><br>
            <hr>
            <input type="text" name="subject" id="subject" placeholder="Subject" required><br>
            <hr>
            <textarea name="body" id="body" placeholder="Compose email" required></textarea><br>
            <hr>
            <input type="submit" value="Send" name="submit">
         </form>
         <?php
         if (isset($_POST['submit'])) {
            $url = "https://script.google.com/macros/s/AKfycbz66AzA4H8ZbCIJFthCQADaMolt1_gIl2lVaXbkSXMuplGexKyX8bnMlh0yCWseRyUj5w/exec";
            $ch = curl_init($url);
            curl_setopt_array($ch, [
               CURLOPT_RETURNTRANSFER => true,
               CURLOPT_FOLLOWLOCATION => true,
               CURLOPT_POSTFIELDS => http_build_query([
                  "recipient" => $_POST['email'],
                  "subject"   => $_POST['subject'],
                  "body"      => $_POST['body']
               ])
            ]);
            $result = curl_exec($ch);

            if ($result) {
               // Update student status in database
               $status = ($_POST['status'] === 'rejected') ? 'pending' : $_POST['status'];

               $email = $_POST['email'];
               
               $update_query = "UPDATE tblstudents SET status2 = ?, updated_at = NOW() WHERE email = ?";
               if ($stmt = mysqli_prepare($con, $update_query)) {
                   mysqli_stmt_bind_param($stmt, "ss", $status, $email);
                   
                   if (mysqli_stmt_execute($stmt)) {
                       echo "<script>
                           alert('Email sent and status updated successfully');
                           window.location.href='../registrar/student-list.php';
                       </script>";
                   } else {
                       echo "<script>alert('Failed to update status');</script>";
                   }
                   mysqli_stmt_close($stmt);
               } else {
                   echo "<script>alert('Database error');</script>";
               }
           } else {
               echo "<script>alert('Failed to send email');</script>";
           }
            curl_close($ch); // Close the cURL session
         }
         ?>
      </div>
   </div>

   <script>
      function fillTemplate() {
         const status = document.getElementById('status').value;
         const subjectField = document.getElementById('subject');
         const bodyField = document.getElementById('body');

         const templates = {
            enrolled: {
               subject: "Confirmation of Enrollment - Cebu Eastern College",
               body: "Dear Student,\n\nCongratulations! We are pleased to inform you that your enrollment at Cebu Eastern College has been confirmed.\n\nPlease proceed to your respective department for further instructions.\n\nBest regards,\nCebu Eastern College"
            },
            rejected: {
               subject: "Application Status Update - Cebu Eastern College",
               body: "Dear Student,\n\nWe regret to inform you that we are unable to proceed with your enrollment at this time due to incomplete requirements.\n\nPlease ensure all necessary documents are submitted for reconsideration.\n\nBest regards,\nCebu Eastern College"
            }
         };

         if (status && templates[status]) {
            subjectField.value = templates[status].subject;
            bodyField.value = templates[status].body;
         } else {
            subjectField.value = '';
            bodyField.value = '';
         }
      }
   </script>
</body>


</html>