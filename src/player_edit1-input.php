<?php session_start(); 
	$_SESSION['player_id']=$_GET['player_id'];
	
?>
<?php require "db-connect.php" ?>
<?php require "head.php" ?>




<form action="player_edit2-input.php" method="post">
    <center>
    <h2>選手登録変更</h2>
    <p>選手名</p>
    <input type="text" name="player_name">
    <p>背番号</p>
    <input type="number" name="number">
    <p>ポジション</p>
    <input type="radio" name="position" value="1"> 投手
    <input type="radio" name="position" value="2"> 捕手
    <input type="radio" name="position" value="3"> 内野手
    <input type="radio" name="position" value="4"> 外野手
    
    <p>出身地</p>
    <p><select name="home">
	<option value="01">北海道</option>
	<option value="02">青森県</option>
	<option value="03">岩手県</option>
	<option value="04">宮城県</option>
	<option value="05">秋田県</option>
	<option value="06">山形県</option>
	<option value="07">福島県</option>
	<option value="08">茨城県</option>
	<option value="09">栃木県</option>
	<option value="10">群馬県</option>
	<option value="11">埼玉県</option>
	<option value="12">千葉県</option>
	<option value="13">東京都</option>
	<option value="14">神奈川県</option>
	<option value="15">新潟県</option>
	<option value="16">富山県</option>
	<option value="17">石川県</option>
	<option value="18">福井県</option>
	<option value="19">山梨県</option>
	<option value="20">長野県</option>
	<option value="21">岐阜県</option>
	<option value="22">静岡県</option>
	<option value="23">愛知県</option>
	<option value="24">三重県</option>
	<option value="25">滋賀県</option>
	<option value="26">京都府</option>
	<option value="27">大阪府</option>
	<option value="28">兵庫県</option>
	<option value="29">奈良県</option>
	<option value="30">和歌山県</option>
	<option value="31">鳥取県</option>
	<option value="32">島根県</option>
	<option value="33">岡山県</option>
	<option value="34">広島県</option>
	<option value="35">山口県</option>
	<option value="36">徳島県</option>
	<option value="37">香川県</option>
	<option value="38">愛媛県</option>
	<option value="39">高知県</option>
	<option value="40">福岡県</option>
	<option value="41">佐賀県</option>
	<option value="42">長崎県</option>
	<option value="43">熊本県</option>
	<option value="44">大分県</option>
	<option value="45">宮崎県</option>
	<option value="46">鹿児島県</option>
	<option value="47">沖縄県</option>
	</select></p>
    <p>年俸</p>
    <input type="text" name="salary">
    <p>在籍年数</p>
    <input type="text" name="year">
    <p><input type="submit" value="登録"></p>
    </center>
</form>
</body>
</html>
