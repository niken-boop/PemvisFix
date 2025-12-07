<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pinky Todo List</title>
    <style>
        :root {
            --bg-pink: #ffe6eb;
            --card-pink: #fff0f5;
            --dark-pink: #d63384;
            --hot-pink: #ff69b4;
            --soft-border: #ffb7c5;
        }
        body {
            background-color: var(--bg-pink);
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            justify-content: center;
            padding-top: 50px;
            margin: 0;
            color: #555;
        }
        .container {
            width: 100%;
            max-width: 500px;
            background: var(--card-pink);
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 10px 30px rgba(214, 51, 132, 0.15);
            border: 2px solid white;
        }
        h1 {
            text-align: center;
            color: var(--dark-pink);
            margin-bottom: 2rem;
        }
        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }
        input[type="text"] {
            flex: 1;
            padding: 15px 20px;
            border: 2px solid var(--soft-border);
            border-radius: 50px;
            outline: none;
            color: var(--dark-pink);
        }
        input[type="text"]:focus {
            border-color: var(--hot-pink);
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.2);
        }
        .btn-add {
            background: var(--hot-pink);
            color: white;
            border: none;
            padding: 0 25px;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
        }
        .btn-add:hover { background: #ff1493; }

        ul { list-style: none; padding: 0; }
        li {
            background: white;
            margin-bottom: 12px;
            padding: 15px;
            border-radius: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-left: 5px solid var(--soft-border);
        }
        li.done {
            text-decoration: line-through;
            opacity: 0.6;
            border-left-color: #ccc;
        }
        .actions a {
            text-decoration: none;
            margin-left: 5px;
            padding: 5px 10px;
            border-radius: 10px;
            font-size: 14px;
        }
        .btn-check { background: #d4edda; color: #155724; }
        .btn-edit { background: #fff3cd; color: #856404; }
        .btn-del { background: #f8d7da; color: #721c24; }
        
        .alert {
            background: #d1e7dd; color: #0f5132;
            padding: 10px; border-radius: 10px;
            margin-bottom: 20px; text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>🎀 My Pinky Todo</h1>

    <?php if($this->session->flashdata('msg')): ?>
        <div class="alert"><?= $this->session->flashdata('msg'); ?></div>
    <?php endif; ?>

    <?= form_open('todo/add', ['class' => 'input-group']); ?>
        <input type="text" name="title" placeholder="Tulis rencana cantikmu..." required autocomplete="off">
        <button type="submit" class="btn-add">Tambah</button>
    <?= form_close(); ?>

    <ul>
        <?php foreach($todos as $t): ?>
            <li class="<?= $t->is_completed ? 'done' : '' ?>">
                <span><?= htmlspecialchars($t->title) ?></span>
                <div class="actions">
                    <a href="<?= site_url('todo/toggle_status/'.$t->id) ?>" class="btn-check">
                        <?= $t->is_completed ? '↺' : '✓' ?>
                    </a>
                    <a href="<?= site_url('todo/edit/'.$t->id) ?>" class="btn-edit">✎</a>
                    <a href="<?= site_url('todo/delete/'.$t->id) ?>" class="btn-del" onclick="return confirm('Hapus?')">✕</a>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

</body>
</html>