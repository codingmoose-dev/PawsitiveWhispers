<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Animal Case</title>
</head>
<body>
    <h1>Submit an Animal Case</h1>

    <!-- Message display area -->
    <div id="message" style="color: green; font-weight: bold; margin-bottom: 10px;"></div>

    <!-- Form for animal case submission -->
    <form id="animalForm">
        <label for="name">Animal Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="species">Species:</label>
        <input type="text" id="species" name="species" required><br>

        <label for="breed">Breed:</label>
        <input type="text" id="breed" name="breed"><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Unknown">Unknown</option>
        </select><br>

        <label for="animal_condition">Animal Condition:</label>
        <textarea id="animal_condition" name="animal_condition" required></textarea><br>

        <label for="rescue_date">Rescue Date:</label>
        <input type="date" id="rescue_date" name="rescue_date" required><br>

        <label for="case_type">Case Type:</label>
        <select id="case_type" name="case_type" required>
            <option value="injured">Injured</option>
            <option value="adoption">Adoption</option>
        </select><br>

        <!-- Shelter dropdown (hidden initially) -->
        <div id="shelterDropdown" style="display: none;">
            <label for="shelter">Select Shelter:</label>
            <select id="shelter" name="shelter"></select><br>
        </div>

        <button type="submit">Submit</button>
    </form>

    <script src="../js/Script.js"></script>
</body>
</html>
