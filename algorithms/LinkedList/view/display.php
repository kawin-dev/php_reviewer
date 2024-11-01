<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <div class="display-container">
    <div>
      <h1>Linked List Structure</h1>
    </div>
    <div id="inserting">
      <input type="number" id="insert-value" placeholder="Enter number here">
      <button data-type="first" class="insert-action">Insert First</button>
      <button data-type="last" class="insert-action">Insert Last</button>
      <button id="reset-list">Reset List</button>
    </div>
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const insertActions = document.getElementsByClassName('insert-action');
      Array.from(insertActions).forEach(element => {
        element.addEventListener('click', function(event) {
          event.preventDefault();
          const type = element.getAttribute('data-type');

          console.log("type::", type);

          const data = {
            insert_value: document.getElementById('insert-value').value
          };

          fetch(`index.php?action=insert&type=${type}`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
          })
          .then(response => response.json())
          .then(data => {
            console.log("Response:", data);
          })
          .catch(error => {
            console.error("Error:", error);
          });
        });
      });

      document.getElementById('reset-list').addEventListener('click', function(){
        fetch('index.php?action=reset-list', {
          method: 'GET',
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(response => response.json())
        .then(data => {
          console.log(data);
        })
        .catch(error => {
          console.log(error);
        })
      });
    });
  </script>
</body>
</html>