# 1. 프로젝트 소개

## 프로젝트 명: 
New Interactive Visualization System For Long Genome Sequences

## 개요:
<p align="justify"> In essence, this project is intent on developing a web application that provides a user with the possibility to study genome data so as to disencumber them of the necessity to go through the many steps of genome alignment that includes dealing with the command line terminal, installing various packages and libraries needed for the execution of programs that align and compare genomes, and setting up the file system and programming environment. To implement such an application, various tools like JavaScript, Ajax, HTML, CSS, PHP, MySQL, as well as some other server related tools, were utilized. Using PHP, not only was it possible to run terminal commands needed for the execution of alignment algorithms externally but also connect the website with the MySQL database to optimize some processes running on the website and save the data that was uploaded on the website, as well as the data that was obtained as a result of the genome data processing and genome alignment. </p>

## 목적: 
<p align="justify"> The goal of this project is to implement a web platform that provides a user-friendly interface to users wishing to study different genome data without the need to manually run specific programs by themselves, so that even users without the knowledge of how to run terminal commands and install various packages that might be needed for the program execution could compare and analyze genome data. To do so, the programs were abstracted from the user interface, and only the file(s) provided by user is needed to produce an alignment file; hence, an upload function is sought for. In the process of developing a genome data visualization system, gathering information related to the field of comparative genomics and consequent comprehension and analysis of that very information is necessary and set as one of the goals for this project. As a result of this graduation project, it is wanted that a complete working product is built and utilized in real life. Finally, working on this project is thought to help gain experience of making a project in a collaborative environment. </p>

# 2. 팀 소개

Kaztayeva Gulnaz, gulnazka191822@gmail.com, 프론트엔드 개발

Yerzhanov Zineden, yerzhanovz1003@gmail.com, 백앤드 개발

# 3. 시스템 구성도

<p align="center">
<img width="500" alt="flow" src="https://user-images.githubusercontent.com/83392181/195792870-7ae34ea0-a972-4c6a-bda7-9215f738c2a0.png"><br>
<em>Fig. 1. System structure</em>
</p>

<p align="justify"> The main purpose of our visualization tool is to get a graph based on information obtained through files that are uploaded by the user (See Fig. 1). Therefore, after a successful connection, the user must choose to upload or download files. If the user is going to use the website for the first time, he must upload the necessary files, which will be processed and the result uploaded to the database. If she/he has already uploaded the files and wants to get the results, she/he must click on the download button next to the desired format. You can also see the result on the site itself, on the main part of the page a graph of the result of the last uploaded file will be displayed. </p>

# 4. 소개 및 시연 영상

# 5. 설치 및 사용법

## Dependencies
The script requires three R packages: install.packages(c("optparse", "ggplot2", "plotly")).

## Script parameters
Use ./mummerCoordsDotPlotly.R -h to see options.

	-i INPUT, --input=INPUT
		coords file from mummer program 'show.coords' [default NULL]

	-o OUTPUT, --output=OUTPUT
		output filename prefix [default out]

	-v, --verbose
		Print out all parameter settings [default]

	-q MIN-QUERY-LENGTH, --min-query-length=MIN-QUERY-LENGTH
		filter queries with total alignments less than cutoff X bp [default 4e+05]

	-m MIN-ALIGNMENT-LENGTH, --min-alignment-length=MIN-ALIGNMENT-LENGTH
		filter alignments less than cutoff X bp [default 10000]

	-p PLOT-SIZE, --plot-size=PLOT-SIZE
		plot size X by X inches [default 15]

	-l, --show-horizontal-lines
		turn on horizontal lines on plot for separating scaffolds  [default FALSE]

	-k NUMBER-REF-CHROMOSOMES, --number-ref-chromosomes=NUMBER-REF-CHROMOSOMES
		number of sorted reference chromosomes to keep [default all chromosmes]

	-s, --similarity
		turn on color alignments by percent similarity [default FALSE]

	-t, --identity-on-target
		turn on calculation of % identity for on-target alignments only [default FALSE]

	-x, --interactive-plot-off
		turn off production of interactive plotly [default TRUE]

	-r REFERENCE-IDS, --reference-ids=REFERENCE-IDS
		comma-separated list of reference IDs to keep [default NULL]

	-h, --help
		Show this help message and exit

## Example

Compare diploid Brassica rapa and allo-tetraploid Brassica napus (hybrid of B. rapa and B. oleracea)

NB: Some differences between below dot plots (e.g. sparseness of alignments) may be due to filtering parameter settings (-m and -q).

### MUMmer example

	nucmer --maxmatch -l 80 -c 100 Brassica_rapa.faa Brassica_napus_rape.faa -p Brapa_Bnapus.nucmer
	delta-filter -r Brapa_Bnapus.nucmer.delta > Brapa_Bnapus.nucmer.delta.filter
	show-coords -c Brapa_Bnapus.nucmer.delta.filter > Brapa_Bnapus.nucmer.delta.filter.coords
	
Make dot plot:

	../mummerCoordsDotPlotly.R -i Brapa_Bnapus.nucmer.delta.filter.coords -o Brapa_Bnapus.nucmer.plot -m 1000 -q 300000 -k 10 -s -t -l -p 12

![Brapa_Bnapus nucmer plot](https://user-images.githubusercontent.com/83392181/195802562-528b79b0-15ea-4fae-ba26-6946ffaf1a1a.png)
<p align="center">
<em>Fig. 2. Visualized data from mummer file</em>
</p>

### Minimap2 example

	minimap2 -x asm5 Brassica_rapa.faa Brassica_napus_rape.faa > Brapa_Bnapus.minimap2.paf

Make dot plot:

	../pafCoordsDotPlotly.R -i Brapa_Bnapus.minimap2.paf -o Brapa_Bnapus.minimap2.plot -m 2000 -q 500000 -k 10 -s -t -l -p 12

![Brapa_Bnapus minimap2 plot](https://user-images.githubusercontent.com/83392181/195803299-a862b6be-430f-4d8e-b4ef-a550309726a2.png)
<p align="center">
<em>Fig. 3. Visualized data from PAF file</em>
</p>

## Website

Alternatively, one could use the website that was made during this graduation project. To do so, some settings need to be made, like setting up Apache, MySQL database, etc. 

1. Upload the website directory in the 'htdocs' folder under the Apache distribution being used
2. Edit the details of database connection info in 'database.php' file
3. Having done the previous two steps, one can use the website on their localhost server. Alternatively, they can upload it to a server run by CentOS or Linux, as was done during this project.
4. To install this web application to a server, 'scp' and 'ftp' commands could be of help. 

To see how the website works, follow the link 
