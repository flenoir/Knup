/* carpediem v. 1.03: A simple javascript date-picker
*
* Author : Alain Bruguieres (alain.bruguieres@free.fr)
*
* License: GPL; you may use this code freely, provided you don't try to make money with it.
* Provided as is, without any warranty.
* Feel free to use this code, but don't remove this disclaimer please.
* If you to use my code, please listen to a Bach Cantata (if you don't know which one,
* why not try BWV 49 ?) and send me an e-mail.
*
*/




/* GENERAL SETTINGS : feel free to adapt to your needs! */


//Language settings

var Language; //The current language
D_Language="FR"; //the langage par excellence

// other languages="EN", "SP","DE"; etc...

function setlang() {
    switch (Language) {
    case "EN":
    Day_Name=["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"];
    Month_Name=["January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"];
    FirstDay=0; // the week begins on sunday
    break;
    case "SP":
    Day_Name=["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "S&aacute;"];
    Month_Name=["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
    "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    FirstDay=0;
    break;
    case "DE":
    Day_Name=["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"];
    Month_Name=["Januar", "Februar", "M&auml;rz", "April", "Mai", "Juni", "Juli",
    "August", "September", "Oktober", "November", "Dezember"];
    FirstDay=0;
    break;
    default:
    Day_Name=["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"];
    Month_Name=["Janvier", "F&eacute;vrier", "Mars", "Avril", "Mai", "Juin", "Juillet",
    "Ao&ucirc;t", "Septembre", "Octobre", "Novembre", "D&eacute;cembre"];
    FirstDay=1; // la semaine commence lundi
    break;
    }
}

// Default Date Format

var Template; // The current date format
D_Template="YYYY-MM-DD"; // The default


    /* Other examples : "DD-MM-YYYY", "DD MM YY", etc... Accepts "DD" for day, "MM" for month,
    "YYYY" and "YY" for 4-digit and 2-digit year respectively */




//Calendar Dimensions

cell_width=22;
cell_height=20;
border_width=0;
cell_spacing=2;

cell_WIDTH=cell_width+2*border_width;
cell_HEIGHT=cell_height+2*border_width;
table_width=7*cell_WIDTH+8*cell_spacing;
cal_width=table_width+40;


//Calendar Appearence

bg_color="#646464"; //background
bandeau_color="#FF9966";
day_color="white"; //ordinary day of current month
offday_color="#D2B48C"; // day of other month
we_color="#FFFFCC"; // week-end
today_color="#FF0000"; // today

var calcss="body, select, option, table {font-family:sans-serif; font-size: 12px;} ";

calcss+="body {background-color: "+bg_color+";align:center;text-align:center;} "


//styles de cellules
bandeau_sty=  "font-size: 12px; background-color : "+bandeau_color+"; width:"+cell_WIDTH+"px;text-align:center;";
cell_sty=     "font-size: 10px; font-weight: bold; text-align:center; height:"+cell_height+"px;border-width:"+border_width+";border-style:outset;";
cell_on_sty=  "background-color : "+day_color+";";
cell_off_sty= "font-size: 10px; background-color : "+offday_color+";text-align:center;";
cell_we_sty=  "background-color : "+we_color+";";
hodie_sty=    "background-color : "+today_color+";";

onmouse=" onmouseover=\"this.style.borderStyle='inset'\""+
    " onmouseout=\"this.style.borderStyle='outset'\"";



/* End of GENERAL SETTINGS ------------------------------ */

// Date initialization


var cur_date;  // cur_date is the currently selected date


var Hodie; // Today in the current date format



// The main function
function open_cal() { // arguments : invoker, [language], [template]

    var argv=open_cal.arguments;
    var na=argv.length;

    invoker=argv[0]; // the first argument is the id of the 'client' control;
             // store it in global variable invoker

    if (na>1) {Language=argv[1];}
    else {Language=D_Language;} //the default
    setlang();

    if (na>2) {Template=argv[2];}
    else {Template=D_Template;}

    // Date initialization

    cur_date= new Date(); // the default for cur_date is today

    // set Hodie
    Hodie= format(cur_date.getFullYear(),cur_date.getMonth()+1,cur_date.getDate());


    // recover cur_date from the client control  (unless invalid)
    var date0=unformat(this.document.getElementById(invoker).value);
    if (date0 !="invalid")
        {cur_date=new Date(date0);}


    open_cal0();
}

// Open the calendar pop-up
function open_cal0() {



    // fill in the calendar popup with data for the current month

    var month=cur_date.getMonth()+1;
    var year=cur_date.getFullYear();

    // length of this and previous months
    var longueur=month_length(month,year);
    var longueur_prec=month_length(month-1,year);

    //  compute number of empty cells on first line
    var premier_jour=the_first(month,year)-FirstDay;
    if (premier_jour<0) {premier_jour+=7;}

    var ornement;
    var val;
    var onBlur=" onBlur=\"window.close();\"";
    if (isIE()>0) {onBlur="";}   //Eh oui; un patchounet pour IE, et un!

    // prepare the month and the year selectors

    var monthselector="<div width='100px'><select name='monthselector' width='90%' onChange='javascript:var toto=this.value;window.opener.resetmonth(toto);'>";
    for (i=0; i<12; i++) {
    if (i==month-1)
        {monthselector+="<option value='"+i+"' selected>"+Month_Name[i];}
    else
        {monthselector+="<option value='"+i+"'>"+Month_Name[i];}
    }
    monthselector+="</select></div>";

    var bigbang=year-9;
    var bigcrunch=year+10;

    var yearselector="<select name='yearselector' onChange='javascript:var toto=this.value;window.opener.resetyear(toto);'>";
    for (i=bigbang;i<bigcrunch;i++) {
    if (year==i)
        {yearselector+="<option value='"+i+"' selected>"+i;}
    else
        {yearselector+="<option value='"+i+"'>"+i;}
    }
    yearselector+="</select>";

    // compute how many weeks to display

    var s_max=Math.ceil((longueur+premier_jour)/7);

    // open the pop-up

    calwin = window.open("", "CarpeDiem", "width="+cal_width+",height="+(cell_height*8)+",top=100,left=865,resizable=yes,status=no");
    var Hauteur=(cell_height+cell_spacing)*(s_max+8)+cell_spacing;
    calwin.resizeTo(cal_width,Hauteur);
    calwin.document.close();
    calwin.defaultstatus="CarpeDiem";
    calwin.focus();


    //  build the html code = entete+navbar+bandeau+mois+fin

    var entete="<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0//EN'><HTML><HEAD><STYLE type='text/css'><!--"
    + calcss + "--></STYLE></HEAD><body "  + onBlur + " >";

    var fin="</html></body>";

    var navbar="<div align=center><table><tr height="+cell_HEIGHT
        +"><td"+setincr(-1)+"><b> < </b></td><td>"+monthselector+"<td"+setincr(+1)
        +"><b> > </b></td><td"+setincr(-12)+"><b> < </b></td><td>"+yearselector
        +"<td"+setincr(+12)+"><b> > </b></td></tr></table></div>";

    var bandeau="<div align=center><table style='width;auto;background-color:gray;' cellspacing="
        +cell_spacing+"><tr height="+cell_HEIGHT+">";
    for (i=0 ; i<7 ; i++) {
        var i_loc=i+FirstDay; if (i_loc> 6) {i_loc+=-7;}
        bandeau+="<td "+setsty(bandeau_sty)+">"+ Day_Name[i_loc] + "</td>";
        }
    bandeau+="</tr>";



    var mois="";
    for (s=0; s<s_max; s++) {
        mois+="<tr height="+cell_HEIGHT+">";

        for (i=0 ; i< 7 ; i++) {
            ornement="";

            var i_loc=i+FirstDay; if (i_loc> 6) {i_loc+=-7;}
            if (i_loc==0 || i_loc==6)
                {ornement+=setsty(cell_sty+cell_we_sty);}

            valeur= 7*s + i - premier_jour +1;
            if (valeur > 0 && valeur <= longueur)
                {val=format(year,month,valeur);
                ornement+=setsty(cell_sty+cell_on_sty)+set_date(invoker,val)+onmouse;
                if (val==Hodie) {ornement=setsty(cell_sty+hodie_sty)+ornement;}
                }
            else
                {ornement=setsty(cell_off_sty);
                    if (valeur > longueur)
                    {valeur-=longueur;}
                if (valeur <=0)
                    {valeur+=longueur_prec;}
                }


            mois+="<td " + ornement + ">" + valeur + "</td>";

        }
        mois+="</tr>";
    }
    mois+="</table></div>";

    calwin.document.write(entete+navbar+bandeau+mois+fin);
    calwin.document.close();

}

// set the style (just for legibility)

function setsty(style) {
    return " style='"+style+"'";
}

// specify the onClick property of a calendar cell
function set_date(control,val) {
    return " onClick='javascript:window.opener.set_control(\"" + control +  "\",\"" + val + "\");window.close();' ";
}

// sets the client control to the date selected
function set_control(control,val) {
    this.document.getElementById(control).value =val;
}


// specify the onClick property of a navbar cell
function setincr(Num) {
    return " onClick='javascript:window.opener.incmonth("+ Num +");'";
}

// change month (relative)
function incmonth(Num) {
    resetmonth(cur_date.getMonth()+Num);
}

// change month (absolute)
function resetmonth(Num) {
    cur_date.setMonth(Num);
    if (isIE()<1) {window.close();}  // Et de deux!
    open_cal0();
}

// change year (absolute)
function resetyear(Num) {
    cur_date.setFullYear(Num);
    if (isIE()<1) {window.close();}  // Et de deux!
    open_cal0();
}

// Auxilliary functions

// length of a month
function month_length(month,year) {
    var d0=new Date(year,month-1,1);
    var d1=new Date(year,month,1);
    return Math.round((d1.getTime()-d0.getTime())/86400000);
}

// weekday of the 1st day of a month
function the_first(month,year) {
    var d0=new Date(year,month-1,1);
    return d0.getDay();
}


//Conversion

function format(year,month,day) { //produces a string according to the Template
    var DAY= chaine(day, 2);
    var MONTH= chaine(month, 2);
    var YEAR= chaine(year,4);
    var AR=chaine(year,2);
    var output=Template.replace("DD",DAY);
    output=output.replace("MM",MONTH);
    output=output.replace("YYYY",YEAR);
    output=output.replace("YY",AR);
    return output;
}

function unformat(dies) { //converts dies from Template format to timestamp (in millliseconds)
    var DD=dies.substr(Template.indexOf("DD"),2);
    var MM=dies.substr(Template.indexOf("MM"),2);
    var YY;
    var YYYY;

    if (Template.indexOf("YYYY")==-1) {
        YY=dies.substr(Template.indexOf("YY"),2);
        if (YY <"70")
            {YYYY="20"+YY;}
        else
            {YYYY="19"+YY;}
        }
    else
        {YYYY=dies.substr(Template.indexOf("YYYY"),4);}
    //check for validity/plausibility
    if (+(DD)<1 || +(DD) >31 || +(MM)< 1 || +(MM)> 12 || +(YYYY)<1900 || +(YYYY)>2100) {return "invalid";}
    var dp=Date.parse(MM + "/" + DD + "/" +YYYY);
    if (dp!=+(dp)) {return "invalid";}

    return dp;
}


function chaine(number,l) { //crudely converts an integer < 10000 to a string of length l < 5
        var str="0000"+number;
    return str.substr(str.length-l,l);
}


function isIE() {
    // My personal experience is that sometimes, a Bach Cantata helps
    // in times of disheartenment.
    return navigator.userAgent.indexOf("MSIE")+1;
}
