<div class="card">
    <div class="card-header">Profile : <?=$_SESSION['sess_user']['user']['username']?></div>
    <div class="card-body">
        <?=json_encode($_SESSION['sess_user'])?>
    </div>
</div>