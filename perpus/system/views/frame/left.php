<?php
function isAct($a,$l){
	global $cview;
	if($a==$cview) return 'class="active" href="'.RLNK.$l.'"';
	else return 'href="'.RLNK.$l.'"';
}
$nbook=dbSRow("catalog");
?>
<style type="text/css">
#leftcolumn{
width: 200px; /*Width of left column*/
}
.innertube{
margin: 10px; /*Margins for inner DIV inside each column (to provide padding)*/
margin-top: 0;
}
.blueblock{
width: 180px;
padding: 0 0 1em 0;
font:12 px'Segoe UI','Trebuchet MS', 'Lucida Grande', Arial, sans-serif;
color: #303942;
}
* html .blueblock{ /*IE 6 only */
width: 147px; /*Box model bug: 180px minus all left and right paddings for .blueblock */
}
.blueblock ul{
list-style: none;
margin: 0;
padding: 0;
border: none;
}
.blueblock li {
margin: 0;
}
.blueblock li a{
display: block;
padding: 5px 5px 5px 8px;
border-left: 5px solid #ffffff;
color: #999;
text-decoration: none;
width: 100%;
}
.blueblock li a:hover{
border-left: 5px solid #ffffff;
color: #303942;
}
.blueblock li .active{
display: block;
padding: 5px 5px 5px 8px;
border-left: 5px solid #1c64d1;
color: #303942;
text-decoration: none;
width: 100%;
}
.blueblock li .active table tr td{
font: 12px 'Segoe UI','Trebuchet MS', 'Lucida Grande', Arial, sans-serif !important;
color: #303942;
}
.blueblock li .active:hover{
border-left: 5px solid #1c64d1;
color: #303942;
}
html>body .blueblock li a{ /*Non IE6 width*/
width: auto;
}
.lianum{
padding:1px 5px;
background:#2c74d1;
border-radius:10px;
font-size:10px;
color:#fff !important;
}
.leftsub{
font:16px 'Segoe UI', Tahoma, sans-serif;color:#303942;margin:10px 0 10px 5px;cursor:default;
}
#bshelf{
	font:16px 'Segoe UI', Tahoma, sans-serif;color:#303942;margin-bottom:10px;margin-left:5px;margin-top:20px
}
#bshelf a span{
	color:#999;
}
#bshelf a:hover span{
	color: #303942;
}
</style>
<div id="leftcolumn">
<div id="bshelf">
<a href="<?=RLNK?>bookshelf.php">
	<table cellspacing="0" cellpadding="0" width="150px" border="0"><tr>
	<td width="28px"><div style="width:24px;height:24px;background:url('<?=IMGR?>main.png');background-position:0px -40px"></div></td>
	<td><span style="font-size:16px">Book shelf</span></td><td align="right"><span class="lianum"><?=$nbook?></span></td></tr></table>
</a>
</div>
<div class="blueblock">
	<ul>
	<li><a <?=isAct("b_manage","bookshelf.php?tab=manage")?>>Manage book shelf</a></li>
	</ul>
</div>
<div class="leftsub">Bibliographic</div>
<div class="blueblock">
	<ul>
	<li><a <?=isAct("b_catalog","bibliographic.php?tab=catalog")?>>Catalog</a></li>
	<li><a <?=isAct("b_author","bibliographic.php?tab=author")?>>Author</a></li>
	<li><a <?=isAct("b_publisher","bibliographic.php?tab=publisher")?>>Publisher</a></li>
	<li><a <?=(($cview=="b_class"||$cview=="b_language")?'class="active"':'href="'.RLNK.'bibliographic.php?tab=class"')?>>More...</a></li>
	</ul>
</div>
<div class="leftsub">Circulation</div>
<div class="blueblock">
	<ul>
	<li><a <?=isAct("b_loan","circulation.php?tab=loan")?>>Loan</a></li>
	<li><a <?=isAct("b_return","circulation.php?tab=return")?>>Return</a></li>
	<li><a <?=isAct("b_fine","circulation.php?tab=fine")?>>Fine</a></li>
	<!--li><a <?=isAct("b_history","circulation.php?tab=history")?>>History</a></li-->
	</ul>
</div>
<div class="leftsub">Membership</div>
<div class="blueblock">
	<ul>
	<li><a <?=isAct("b_staff","members.php?tab=staff")?>>Teacher & staff</a></li>
	<li><a href="javascript:void(0)">Student</a></li>
	<li><a href="javascript:void(0)">Other</a></li>
	</ul>
</div>
<div class="leftsub">Tools</div>
<div class="blueblock">
	<ul>
	<li><a <?=isAct("b_label","label.php")?>>Print label</a></li>
	<li><a <?=isAct("b_stopname","stockopname.php")?>>Stock opname</a></li>
	<li><a href="javascript:void(0)">Preferences</a></li>
	</ul>
</div>
</div>