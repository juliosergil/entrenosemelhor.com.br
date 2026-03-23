<?php include template("manage_header"); ?>

<style>
/* ======== CARD NOVO (MODELO DA SEGUNDA IMAGEM) ======== */

.upload-card {
    background: #fff;
    border-radius: 10px;
    border: 1px solid #dcdcdc;
    padding: 18px;
    margin-bottom: 25px;
    display: flex;
    align-items: flex-start;
    gap: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
}

.upload-card img {
    width: 110px;
    height: auto;
    border-radius: 6px;
    border: 1px solid #e0e0e0;
}

.upload-info {
    flex: 1;
}

.upload-info .file-name {
    font-weight: bold;
    font-size: 15px;
    margin-bottom: 3px;
}

.upload-info .resolution {
    font-size: 13px;
    color: #555;
    margin-bottom: 10px;
}

.upload-info input[type="file"] {
    margin-bottom: 10px;
    display: block;
}

.upload-info .formbutton {
    background: #007bff;
    color: #fff !important;
    border-radius: 5px;
    border: none;
    padding: 7px 18px;
    cursor: pointer;
    font-size: 14px;
}

.upload-info .formbutton:hover {
    background: #0056d2;
}

/* ======== RESPONSIVIDADE ======== */
@media (max-width: 650px) {
    .upload-card {
        flex-direction: column;
        text-align: center;
        align-items: center;
    }

    .upload-card img {
        width: 80%;
        max-width: 200px;
    }

    .upload-info input[type="file"] {
        margin: 0 auto 10px auto;
    }

    .upload-info .formbutton {
        width: 100%;
        max-width: 180px;
        margin: 0 auto;
    }
}
</style>


<div id="bdw" class="bdw">
    <div id="bd" class="cf">
        <div id="system">

            <div class="dashboard" id="dashboard">
                <ul><?php echo mcurrent_system('redes'); ?></ul>
            </div>

            <div id="content" class="clear mainwide">
                <div class="clear box">
                    <div class="box-top"></div>

                    <div class="box-content">
                        <div class="option_box">
                            <div class="top-heading group">
                                <div class="left_float"><h4>Alterar Imagens do Slider da Homepage (após o envio, aperte CTRL+F5 para remover o cache)</h4></div>
                            </div>

                            <a target="_blank" href="https://resizeyourimage.com/PT/">Clique aqui para redimensionar sua imagem</a><br>
                            <a target="_blank" href="http://www.youtube.com/watch?v=uyCbxw7lU4Q">Veja como é fácil</a><br><br>

                            <!-- ======================== CARD 1 =============================== -->
                            <div class="upload-card">
                                <img src="<?= $ROOTPATH ?>/js/fullscreenslideshow/images/1.jpg">

                                <div class="upload-info">
                                    <div class="file-name">1.jpg</div>
                                    <div class="resolution">Resolução ideal (1400px largura × 850px altura)</div>

                                    <form name="img1" action="<?php echo $INI['system']['wwwprefix'] ?>/include/upload.php?nome=1&width=240&height=96"
                                          target="upload_target" method="post" enctype="multipart/form-data" onsubmit="startUpload();">

                                        <input name="myfile" type="file">
                                        <input type="submit" name="submitBtn" class="formbutton" value="Upload">

                                        <input type="hidden" value="slider" id="tipo" name="tipo">
                                        <iframe id="upload_target" name="upload_target" src="#"
                                                style="width:0;height:0;border:0"></iframe>
                                        <p id="f1_upload_process">Carregando...</p>
                                        <p id="result"></p>
                                    </form>
                                </div>
                            </div>


                            <!-- ======================== CARD 2 =============================== -->
                            <div class="upload-card">
                                <img src="<?= $ROOTPATH ?>/js/fullscreenslideshow/images/2.jpg">

                                <div class="upload-info">
                                    <div class="file-name">2.jpg</div>
                                    <div class="resolution">Resolução ideal (1400px largura × 850px altura)</div>

                                    <form name="img2" action="<?php echo $INI['system']['wwwprefix'] ?>/include/upload.php?nome=2&width=240&height=96"
                                          target="upload_target" method="post" enctype="multipart/form-data" onsubmit="startUpload();">

                                        <input name="myfile" type="file">
                                        <input type="submit" name="submitBtn" class="formbutton" value="Upload">

                                        <input type="hidden" value="slider" id="tipo" name="tipo">
                                        <iframe id="upload_target" name="upload_target" src="#"
                                                style="width:0;height:0;border:0"></iframe>
                                        <p id="f1_upload_process">Carregando...</p>
                                        <p id="result"></p>
                                    </form>
                                </div>
                            </div>


                            <!-- ======================== CARD 3 =============================== -->
                            <div class="upload-card">
                                <img src="<?= $ROOTPATH ?>/js/fullscreenslideshow/images/3.jpg">

                                <div class="upload-info">
                                    <div class="file-name">3.jpg</div>
                                    <div class="resolution">Resolução ideal (1400px largura × 850px altura)</div>

                                    <form name="img3" action="<?php echo $INI['system']['wwwprefix'] ?>/include/upload.php?nome=3&width=240&height=96"
                                          target="upload_target" method="post" enctype="multipart/form-data" onsubmit="startUpload();">

                                        <input name="myfile" type="file">
                                        <input type="submit" name="submitBtn" class="formbutton" value="Upload">

                                        <input type="hidden" value="slider" id="tipo" name="tipo">
                                        <iframe id="upload_target" name="upload_target" src="#"
                                                style="width:0;height:0;border:0"></iframe>
                                        <p id="f1_upload_process">Carregando...</p>
                                        <p id="result"></p>
                                    </form>
                                </div>
                            </div>


                            <!-- ======================== CARD 4 =============================== -->
                            <div class="upload-card">
                                <img src="<?= $ROOTPATH ?>/js/fullscreenslideshow/images/4.jpg">

                                <div class="upload-info">
                                    <div class="file-name">4.jpg</div>
                                    <div class="resolution">Resolução ideal (1400px largura × 850px altura)</div>

                                    <form name="img4" action="<?php echo $INI['system']['wwwprefix'] ?>/include/upload.php?nome=4&width=240&height=96"
                                          target="upload_target" method="post" enctype="multipart/form-data" onsubmit="startUpload();">

                                        <input name="myfile" type="file">
                                        <input type="submit" name="submitBtn" class="formbutton" value="Upload">

                                        <input type="hidden" value="slider" id="tipo" name="tipo">
                                        <iframe id="upload_target" name="upload_target" src="#"
                                                style="width:0;height:0;border:0"></iframe>
                                        <p id="f1_upload_process">Carregando...</p>
                                        <p id="result"></p>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="box-bottom"></div>
                </div>
            </div>

        </div>
    </div>
</div>


<script>
function startUpload() {
    document.getElementById('f1_upload_process').style.visibility = 'visible';
    return true;
}

function stopUpload(success) {
    if (success == 1) {
        jQuery.colorbox({html:"<font color=blue>O arquivo foi carregado com sucesso. Aperte CTRL+F5 no site para limpar o cache.</font>"});
        location.href="<?=$ROOTPAHT?>/vipmin/system/background.php";
    } else {
        jQuery.colorbox({html:"<font color=red>Não foi possível enviar o arquivo.</font>"});
    }

    document.getElementById('f1_upload_process').style.visibility = 'hidden';
    return true;
}
</script>

