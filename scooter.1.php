<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Scooter Management</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      text-align: center;
    }

    #scooterForm {
      margin-bottom: 20px;
    }

    #scooterForm select, #scooterForm button {
      margin-right: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table, th, td {
      border: 1px solid black;
    }

    th, td {
      padding: 10px;
      text-align: left;
    }

    .green {
      color: green;
    }

    .blue {
      color: blue;
    }

    .red {
      color: red;
    }
    .back-button {
            position: absolute;
            top: 10px;
            right: 10px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #dc3545;
            border: circular;
            border-radius: 10px;
            font-size: 16px;
            transition: background-color 0.3s;
        }
  </style>
</head>
<body>
  <h1>CRUD Scooter Management</h1>
  <div id="scooterForm">
    <input type="text" id="scooterNumber" placeholder="Scooter Number">
    <select id="scooterColor">
      <option value="red">Red</option>
      <option value="blue">Blue</option>
      <option value="green">Green</option>
      <option value="yellow">Yellow</option>
      <option value="orange">Orange</option>
      <option value="purple">Purple</option>
      <option value="grey">Grey</option>
      <option value="black">Black</option>
      <option value="white">White</option>
      <option value="pink">Pink</option>
    </select>
    <select id="scooterStatus">
      <option value="available">Available</option>
      <option value="inUse">In Use</option>
      <option value="maintenance">Maintenance</option>
    </select>
    <button onclick="addScooter()">Add Scooter</button>
  </div>
  <table id="scooterTable">
    <tr>
      <th>Scooter Number</th>
      <th>Color</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
  </table>
 <button class="button back-button" onclick="goBack()">Back</button>
  <script>
    let scooters = [];

    function addScooter() {
      const number = document.getElementById('scooterNumber').value;
      const color = document.getElementById('scooterColor').value;
      const status = document.getElementById('scooterStatus').value;

      const newScooter = {
        number: number,
        color: color,
        status: status
      };

      scooters.push(newScooter);
      displayScooters();
    }

    function displayScooters() {
      const table = document.getElementById('scooterTable');
      table.innerHTML = `
        <tr>
          <th>Scooter Number</th>
          <th>Color</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      `;

      scooters.forEach((scooter, index) => {
        let statusClass;
        switch(scooter.status) {
          case 'available':
            statusClass = 'green';
            break;
          case 'inUse':
            statusClass = 'blue';
            break;
          case 'maintenance':
            statusClass = 'red';
            break;
        }

        const row = table.insertRow();
        row.innerHTML = `
          <td>${scooter.number}</td>
          <td style="color: ${scooter.color}">${scooter.color}</td>
          <td class="${statusClass}">${scooter.status}</td>
          <td><button onclick="deleteScooter(${index})">Delete</button></td>
        `;
      });
    }

    function deleteScooter(index) {
      scooters.splice(index, 1);
      displayScooters();
    }
     function goBack() {
            window.history.back();
        }
  </script>
</body>
</html>
