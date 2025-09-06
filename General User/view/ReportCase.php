    <!-- Submit Case Section -->
    <section id="submit-case">
        <h2>Submit Animal Injury Cases</h2>
        <p>Spotted an injured animal? Submit a case by providing details, photos/videos, and location. Our team will take it from there!</p>
        <button id="show-submit-case" class="btn">Submit a Case</button>

        <!-- Hidden Form for animal case submission -->
        <div id="SubmitCaseContent" class="grid-container" style="display: none;">
            <h1>Submit an Animal Case</h1>
            <form id="animalForm" enctype="multipart/form-data">
                <div class="form-grid">
                    <label for="Name">Animal Name:</label>
                    <input type="text" id="Name" name="Name">
                </div>
                <div class="form-grid">
                    <label for="Species">Species:</label>
                    <input type="text" id="Species" name="Species">
                </div>
                <div class="form-grid">
                    <label for="Breed">Breed:</label>
                    <input type="text" id="Breed" name="Breed">
                </div>
                <div class="form-grid">
                    <label for="Age">Age:</label>
                    <input type="number" id="Age" name="Age">
                </div>
                <div class="form-grid">
                    <label for="Gender">Gender:</label>
                    <select id="Gender" name="Gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Unknown">Unknown</option>
                    </select>
                </div>
                <div class="form-grid">
                    <label for="AnimalCondition">Animal Condition:</label>
                    <select id="AnimalCondition" name="AnimalCondition">
                        <option value="Healthy">Healthy</option>
                        <option value="Injured">Injured</option>
                    </select>
                </div>
                <div class="form-grid">
                    <label for="RescueDate">Rescue Date:</label>
                    <input type="date" id="RescueDate" name="RescueDate">
                </div>
                <div class="form-grid">
                    <label for="AdoptionStatus">Adoption Status:</label>
                    <select id="AdoptionStatus" name="AdoptionStatus">
                        <option value="UnderCare">Under Care</option>
                        <option value="Adopted">Adopted</option>
                        <option value="Available">Available</option>
                    </select>
                </div>
                <div id="shelterDropdown" class="form-grid">
                    <label for="ShelterID">Select Shelter:</label>
                    <select id="ShelterID" name="ShelterID"></select>
                </div>
                <div class="form-grid">
                    <label for="picture">Animal Picture:</label>
                    <input type="file" id="picture" name="picture" accept="image/*">
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </section>
