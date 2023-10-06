<!-- Profile Section -->
<?php
$sid=$_SESSION["uid"];
if(isset($_GET["uid"]))
{
  $uid=$_GET["uid"];
  $user=queryUser($conn,$uid);
}
else{
  $user=queryUser($conn,$sid);
}
?>
<div class="profile-container" >
        <div class="profile-description">
            <div class="profile-name">
                <ul>
                    <li>
                        <h3>Location:</h3>
                        <p><?php echo $user['Address'] ?></p>  
                    </li>
                    <br>
                    <li>
                        <h3>Email:</h3>
                        <a href=""><?php echo $user['Email'] ?></a>
                    </li>
                    <br>
                    <li>
                        <h3>Github Link:</h3>
                        
                        <a href="<?php echo $user['github_link'] ?>" style="color:blue;">Click Here</a>
                    </li>                
                </ul>
                
            </div>

            <div class="bio-section">
                <h3>Bio:</h3>
                <p><?php echo $user['bio'] ?> </p>
            </div>
            <?php if(!isset($_GET["uid"])||$_GET["uid"]===$_SESSION["uid"]){?>
            <a target="_blank" href="../profile_dashboard" class="styled-button">Profile Dashboard</a>
            <?php }?>
            <?php 
            if(isset($_GET["uid"]))
            {
            $uid=$_GET["uid"];
            }
            else{
                $uid=$sid; 
            }
            if(file_exists("../uploads/cv/". $uid.".pdf")){?>
            <a target="_blank" href="../uploads/cv/<?php echo $uid;?>.pdf" class="styled-button">CV</a>
            <?php }?>
        </div>

            <div class="profile-showcase">
                <div class="projects">
                <?php
                $query="SELECT name,pid FROM projects WHERE uid = $uid LIMIT 5;";
                $result=mysqli_query($conn,$query);
                $projects=array();
                while($row=$result->fetch_assoc())
                {
                    $projects[]=array(
                        "name"=>$row['name'],
                        "pid"=>$row['pid']
                    );
                }
                ?>
                    <h3>Projects:</h3>
                    <?php
                    foreach($projects as $project)
                    {
                    ?>
                    <button style="margin:0;" 
                    onclick="fetchProject(<?php echo $project['pid'];?>)" class="inline-button show-popup">
                    <?php echo $project['name'];?>
                </button>
                    <?php
                    }
                    ?>
                </div>
                <?php
                if(isset($_GET["uid"]))
                {
                $uid=$_GET["uid"];
                }
                else{
                    $uid=$sid; 
                }
                $query="SELECT name,cert_id FROM certifications WHERE uid = $uid LIMIT 5;";
                $result=mysqli_query($conn,$query);
                $certs=array();
                while($row=$result->fetch_assoc())
                {
                    $certs[]=array(
                        "name"=>$row['name'],
                        "cert_id"=>$row['cert_id']
                    );
                }
                ?>
                <div class="certification">
                    <h3>Certification:
                        
                    </h3>
                    <?php
                    foreach($certs as $cert)
                    {
                    ?>
                    <a target="_blank" class="inline-button" href="../uploads/certifications/<?php echo $cert['cert_id'];?>.png"><?php echo $cert['name'];?></a>
                    <?php
                    }
                    ?>
                    
                </div>
                <?php
                $query="SELECT name,skill_id FROM skills WHERE uid = $uid LIMIT 5;";
                $result=mysqli_query($conn,$query);
                $skills=array();
                while($row=$result->fetch_assoc())
                {
                    $skills[]=array(
                        "name"=>$row['name'],
                        "skill_id"=>$row['skill_id']
                    );
                }
                ?>
                <div class="skills">
                    <h3>Skills:</h3>
                    <?php
                    foreach($skills as $skill)
                    {
                    ?>
                    <button style="margin:0;" onclick="fetchSkill(<?php echo $skill['skill_id'];?>)" class="inline-button show-popup"><?php echo $skill['name'];?></button>
                    <?php
                    }
                    ?>
                    
                </div>
                
    <div id="popup-container" class="popup">
        <div class="popup-content">
            <span class="close" id="close-popup">&times;</span>
            <div>

            </div>
        </div>
    </div>

            </div>
    </div>


    <style>


        .popup {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
        }

        .popup-content {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            max-width: 80%;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 24px;
            cursor: pointer;
        }


    </style>
    <script>
        const showPopupButton = $(".show-popup");
        const closePopupButton = $("#close-popup");
        const popupContainer = $("#popup-container");
        const popupContent = $(".popup-content");
        const contentDiv=popupContent.find("div");
        showPopupButton.click(function() {
                popupContainer.fadeIn();
            });

            closePopupButton.click(function() {
                popupContainer.fadeOut();
            });
        function fetchSkill(id)
        {
            contentDiv.html('')
            let element="";
            fetch("../components/fetch_skills.php/?skill_id="+id+"&uid=<?php echo $uid;?>")
            .then((response)=>{
                return response.json();
            }).then((data)=>{
                element=`<h1 style="text-align:center;">Skill Name: `+data[0].name+`</h1>`+`<h3 style="text-align:center;"> Skill Description: `+data[0].description+`</h3>`
                contentDiv.append(element);
            });
        }
        function isLink(str) {
            return str.startsWith("https://");
            }
        function fetchProject(id)
        {
            contentDiv.html('')
            let element="";
            fetch("../components/fetch_project.php/?project_id="+id+"&uid=<?php echo $uid;?>")
            .then((response)=>{
                return response.json();
            }).then((data)=>{
                let repoLink="#";
                let target='';
                if(data[0].repo.startsWith("https://") || data[0].repo.startsWith("http://"))
                {
                    repoLink=data[0].repo;
                    target='target="_blank"';
                }
                element=`<h1 style="text-align:center;">Project Name: `+data[0].name+`</h1>`+`<h3 style="text-align:center;"> Project Description: `+data[0].description+`</h3><br><a class="inline-button" href="`+repoLink+`" `+target+`>Visit Repo</a>`;
                contentDiv.append(element);
            });
        }

    </script>