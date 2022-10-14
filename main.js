$(document).ready(function() {  
    var p1 = "<ul><li>implement a user friendly interface</li>" + 
    "<li>implement a a scaffolding visualization tool</li>" +
    "<li>learn more information about the comparative genomics</li>" +
    "<li>produce a complete working product that can be further improved</li>" + 
    "<li>gain experience of making a project in a collaborative environment</li>" + 
    "</ul>";  

    var p2 =  "<iframe id='gallery' src='tools.php' frameBorder='0' width = '100%' height = '100%' overflow='scroll'></iframe>";

    var p3 = "<ul><li>Experiment1: </li>"+
        "<img src='img/exp1.png' width = '700' height = '400'><br>" +
        "<li>Experiment2 : </li>"+
        "<img src='img/exp2.png' width = '700' height = '400'><br>" +
        "<li>Experiment3 : </li>"+
         "<img src='img/exp3.png' width = '700' height = '400'><br></ul>";
      
    var p4 = 
         "<iframe id='gallery' src='result.php' frameBorder='0' width = '100%' height = '100%' overflow='scroll'></iframe>";
        

    var p5 = "<ul><li><img src='img/Zineden.jpeg' width = '240' height = '290'><p>Yerzanov Zineden</p></li>"+
        "<li><img src='img/Gulnaz.jpeg' width = '240' height = '290'><p>Kaztayeva Gulnaz</p></li></ul>";
        
    var p6 = "<ul><li>1. Alignment of Entire Genomes (MUMmer) CMSC 423 Carl Kingsford. (n.d.). Retrieved September 28, 2022, from https://www.cs.cmu.edu/~ckingsf/bioinfo-lectures/mummer.pdf</li>"+
        "<li>2. D-GENIES - Dotplot large Genomes in an Interactive, Efficient and Simple way. (n.d.). Dgenies.toulouse.inra.fr. Retrieved September 28, 2022, from https://dgenies.toulouse.inra.fr/documentation/formats</li>"+
        "<li>3. The MUMmer Home Page. (n.d.). Mummer.sourceforge.net. Retrieved September 28, 2022, from https://mummer.sourceforge.net</li>"+
        "<li>4. dotPlotly/example at master · tpoorten/dotPlotly. (n.d.). GitHub. Retrieved September 28, 2022, from https://github.com/tpoorten/dotPlotly/tree/master/example</li></ul>"+
        "<li>5. Delaney, N. (2020, April 23). Usage. GitHub. https://github.com/evolvedmicrobe/dotplot</li>" +  
        "<li>6. Li, H. (2018). Minimap2: pairwise alignment for nucleotide sequences. Bioinformatics, 34(18), 3094–3100. https://doi.org/10.1093/bioinformatics/bty191</li>" +
        "<li>7. Alonge, M., Soyk, S., Ramakrishnan, S., Wang, X., Goodwin, S., Sedlazeck, F. J., Lippman, Z. B., & Schatz, M. C. (2019). RaGOO: fast and accurate reference-guided scaffolding of draft genomes. Genome Biology, 20(1). https://doi.org/10.1186/s13059-019-1829-6</li>";

    $("#goals").click(function() {  
        $(".upload").html(p1);  
        var slide1 = document.getElementById("toggle");
        var slide2 = document.getElementById("toggletwo");
        var slide3 = document.getElementById("togglethree");
        slide1.style.visibility = "hidden";
        slide2.style.visibility = "hidden";
        slide3.style.visibility = "hidden";
    });  

    $("#tools").click(function() {  
        $(".upload").html(p2);  
        var slide1 = document.getElementById("toggle");
        var slide2 = document.getElementById("toggletwo");
        var slide3 = document.getElementById("togglethree");
        slide1.style.visibility = "hidden";
        slide2.style.visibility = "hidden";
        slide3.style.visibility = "hidden";
    });  

    $("#experiments").click(function() {  
        $(".upload").html(p3);  
        $('.upload').css({overflow: 'scroll'});
        var slide1 = document.getElementById("toggle");
        var slide2 = document.getElementById("toggletwo");
        var slide3 = document.getElementById("togglethree");
        slide1.style.visibility = "hidden";
        slide2.style.visibility = "hidden";
        slide3.style.visibility = "hidden";
    });  

    $("#results").click(function() {  
        $(".upload").html(p4);  
        var slide1 = document.getElementById("toggle");
        var slide2 = document.getElementById("toggletwo");
        var slide3 = document.getElementById("togglethree");
        slide1.style.visibility = "hidden";
        slide2.style.visibility = "hidden";
        slide3.style.visibility = "hidden";
    });  

    $("#members").click(function() {  
        $(".upload").html(p5);  
        var slide1 = document.getElementById("toggle");
        var slide2 = document.getElementById("toggletwo");
        var slide3 = document.getElementById("togglethree");
        slide1.style.visibility = "hidden";
        slide2.style.visibility = "hidden";
        slide3.style.visibility = "hidden";
    });  

    $("#references").click(function() {  
        $(".upload").html(p6);  
        var slide1 = document.getElementById("toggle");
        var slide2 = document.getElementById("toggletwo");
        var slide3 = document.getElementById("togglethree");
        slide1.style.visibility = "hidden";
        slide2.style.visibility = "hidden";
        slide3.style.visibility = "hidden";
    }); 

}); 