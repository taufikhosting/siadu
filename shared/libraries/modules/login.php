<div id="loginscreen" style="display:">
	<table cellspacing="0" cellpadding="0" width="100%" border="0"><tr height="300px"><td align="center">
			<div id="loader0" class="loader" style="float:none;display:none"></div>
			<table id="loginform" cellspacing="10px" cellpadding="0" border="0">
				<tr valign="top">
					<td align="center"><img src="<?=IMGR?>usera.png"/></td>
					<td>
						<div style="width:100%;margin-bottom:10px;margin-top:4px">
							<input id="username" type="text" placeholder="User name" class="loginpswd" onfocus="retypeuser()" onkeyup="checkusertype(event)" style="margin-bottom:4px;margin-top:4px"/>
						</div>
						<div style="width:100%;margin-top:10px;margin-bottom:10px">
							<input id="userpasswd" type="password" placeholder="Password" class="loginpswd" onfocus="retypeuser()" onkeyup="checkusertype(event)" style="margin-bottom:4px"/>
						</div>
						<img id="loader4" src="<?=IMGR?>loadsmall.gif" style="display:none" />
						<button id="loginbtn" class="smbtn" title="Login" onclick="userlogin()" style="margin-left:0">Login</button>
						<div id="userwarn" style="width:100%;display:none">
							<div class="swarnbox" style="float:left;margin-top:4px">Wrong username or password!</div>
						</div>
					</td>
				</tr>
			</table>
	</td></tr></table>
	<input type="hidden" id="usession" value=""/>
</div>