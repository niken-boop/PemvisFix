<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Tugas</title>
    <style>
        body { background-color: #ffe6eb; font-family: sans-serif; display: flex; justify-content: center; height: 100vh; align-items: center; margin: 0; }
        .container { background: #fff0f5; padding: 30px; border-radius: 20px; width: 100%; max-width: 400px; text-align: center; border: 2px solid white; box-shadow: 0 10px 25px rgba(255,105,180,0.2); }
        input[type="text"] { width: 80%; padding: 15px; border-radius: 50px; border: 2px solid #ffb7c5; outline: none; margin-bottom: 20px; text-align: center; color: #d63384; }
        .btn-save { background: #ff69b4; color: white; border: none; padding: 10px 25px; border-radius: 50px; cursor: pointer; font-weight: bold; }
        .btn-cancel { background: white; color: #ff69b4; border: 2px solid #ff69b4; text-decoration: none; padding: 8px 25px; border-radius: 50px; margin-right: 10px; display: inline-block;}
    </style>
</head>
<body>

<div class="container">
    <h2 style="color: #d63384;">✏️ Edit Tugas</h2>
    
    <?= form_open('todo/edit/'.$todo->id); ?>
        <input type="text" name="title" value="<?= htmlspecialchars($todo->title) ?>" required autocomplete="off">
        <br>
        <a href="<?= site_url('todo') ?>" class="btn-cancel">Batal</a>
        <button type="submit" name="submit" value="yes" class="btn-save">Simpan</button>
    <?= form_close(); ?>
</div>

</body>
</html>