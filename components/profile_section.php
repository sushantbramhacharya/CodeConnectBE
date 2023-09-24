<!-- Profile Section -->
<div class="profile-container" >
        <div class="profile-description">
            <div class="profile-name">
                <ul>
                    <li>
                        <h3>Location:</h3>
                        <p>New York,NY</p>  
                    </li>
                    <li>
                        <h3>Email:</h3>
                        <a href="">mandal@gmail.com</a>
                    </li>
                    <li>
                        <h3>Github Link:</h3>
                        <a href="">github.com/mandal</a>
                    </li>                
                </ul>
                
            </div>
            <div class="bio-section">
                <h3>Bio:</h3>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Error, </p>
            </div>
            <?php if(!isset($_GET["uid"])||$_GET["uid"]===$_SESSION["uid"]){?>
            <a href="../profile_dashboard" class="styled-button">Profile Dashboard</a>
            <?php }?>
        </div>

            <div class="profile-showcase">
                <div class="projects">
                    <h3>Projects:</h3>
                    <div class="project-title">
                        <ul>
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Accordion Item #1
                              </button>
                            <li>Title</li>
                            <li>Title</li>
                            <li>Title</li>
                            <li>Title</li>
                        </ul>
                    </div>
                </div>

                <div class="certification">
                    <h3>Certification:</h3>
                </div>

                <div class="skills">
                    <h3>Skills:</h3>
                    <div class="skill-title">
                        <p>HTML</p>
                        <p>JavaScript</p>
                    </div>
                </div>

            </div>
    </div>