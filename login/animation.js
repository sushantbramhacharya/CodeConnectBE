let texts = [
    "<!--HTML-->\n<html>\n<body>\n<h1>Welcome To Code Connect</h1>\n</body>\n</html>",
    "//JavaScript\nconsole.log(\"Code Connect\");",
    "#Python\nprint(\"Code Connect\")",
    "//JAVA\npublic class CodeConnect {\npublic static void main(String[] args) {\n   System.out.println(\"Code Connect\");\n    }\n}"
];

let delay = 100;
if(window.innerWidth<1303)
{
    console.log(window.innerWidth)
    texts = [
        "//PHP\n<?php \necho \"Code Connect\";\n?>",
        "//Ruby\nputs \"Hello, World!\";",
        "#Python\nprint(\"Code Connect\")",
        
    ];
}
let animationElement = document.getElementById("typing-animation");

function typeWriter(text, index, lineIndex) {
    if (index < text.length) {
    if (text.charAt(index) === '\n') {
        animationElement.innerHTML += "<br>";
        lineIndex++;
    } else {
        animationElement.innerHTML += text.charAt(index);
    }
    index++;
    setTimeout(function() {
        typeWriter(text, index, lineIndex);
    }, delay);
    } else {
    setTimeout(function() {
        animationElement.innerHTML = "";
        var nextTextIndex = (texts.indexOf(text) + 1) % texts.length;
        typeWriter(texts[nextTextIndex], 0, 0);
    }, 1000); 
    }
}


typeWriter(texts[0], 0, 0);

