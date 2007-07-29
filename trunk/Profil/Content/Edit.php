<h1>Mein Profil Bearbeiten</h1>

<form action="" method="post" enctype="multipart/form-data">

<table>
<tr><th>Feld</th><th>Veröffentlichen</th><th>Wert</th></tr>
<tr>
	<th><label for="Nickname">Nickname</label></th>
	<td><input type="checkbox" value="1" value="1" <?php echo $Show['Nickname'];?> name="Show[Nickname]" disabled="true" id="Nickname" /></td>
	<td><input type="text" name="Ignore[Nickname]" readonly="true" value="<?php echo $Nickname;?>" /></td>
</tr>
<tr>
	<th><label for="Mail">Mail</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Mail'];?> name="Show[Mail]" id="Mail" /></td>
	<td><input type="text" name="Ignore[Mail]" readonly="true" value="<?php echo $Mail;?>" /></td>
</tr>
<tr>
	<th><label for="Webseite">Webseite</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Webseite'];?> name="Show[Webseite]" id="Webseite" /></td>
	<td><input type="text" name="Values[Webseite]" value="<?php echo $Webseite;?>" /></td>
</tr>
<tr>
	<th><label for="Name">Name</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Name'];?> name="Show[Name]" id="Name" /></td>
	<td><input type="text" name="Values[Name]" value="<?php echo $Name;?>" /></td>
</tr>

<tr>
	<th><label for="Vorname">Vorname</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Vorname'];?> name="Show[Vorname]" id="Vorname" /></td>
	<td><input type="text" name="Values[Vorname]" value="<?php echo $Vorname;?>" /></td>
</tr>

<tr>
	<th><label for="PLZ">PLZ</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['PLZ'];?> name="Show[PLZ]" id="PLZ" /></td>
	<td><input type="text" name="Values[PLZ]" value="<?php echo $PLZ;?>" /></td>
</tr>

<tr>
	<th><label for="Wohnort">Wohnort</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Wohnort'];?> name="Show[Wohnort]" id="Wohnort" /></td>
	<td><input type="text" name="Values[Wohnort]" value="<?php echo $Wohnort;?>" /></td>
</tr>

<tr>
	<th><label for="Profilbild">Profilbild</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Profilbild'];?> name="Show[Profilbild]" id="Profilbild" /></td>
	<td><input type="file" name="Profilbild" /></td>
</tr>

<tr>
	<th><label for="Kurzprofil">Kurzprofil</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Kurzprofil'];?> name="Show[Kurzprofil]" id="Kurzprofil" /></td>
	<td><textarea name="Values[Kurzprofil]" cols="40" rows="8"><?php echo $Kurzprofil;?></textarea></td>
</tr>

<tr>
	<th><label for="Kontakt">Kontakt</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Kontakt'];?> name="Show[Kontakt]" id="Kontakt" /></td>
	<td></td>
</tr>

<tr>
	<th><label for="Geburtstag">Geburtstag</label></th>
	<td><input type="checkbox" value="1" <?php echo $Show['Geburtstag'];?> name="Show[Geburtstag]" id="Geburtstag" /></td>
	<td><input type="text" name="Values[Geburtstag]" value="<?php echo $Geburtstag;?>" /></td>
</tr>
</table>
<a href="?Profil">Mein Profil ansehen</a>
<input type="submit" id="Submit" />
</form>