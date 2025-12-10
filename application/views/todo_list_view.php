<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        padding-top: 30px; 
        padding-bottom: 30px;
        margin: 0;
        color: #555;
        min-height: 100vh;
    }

    .container {
        width: 90%;
        max-width: 800px;
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

    .add-todo-form {
        margin-bottom: 25px;
    }

    .input-group {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }
    input[type="text"] {
        flex: 1;
        padding: 15px 20px;
        border: 2px solid var(--soft-border);
        border-radius: 50px;
        outline: none;
        color: var(--dark-pink);
        min-width: 200px;
    }

    input[type="text"]:focus {
        border-color: var(--hot-pink);
        box-shadow: 0 0 10px rgba(255, 105, 180, 0.2);
    }

    .btn-add {
        background: var(--hot-pink);
        color: white;
        border: none;
        padding: 15px 30px;
        border-radius: 50px;
        font-weight: bold;
        cursor: pointer;
        white-space: nowrap;
    }
    .btn-add:hover { background: #ff1493; }

    .datetime-group {
        display: flex;
        gap: 10px;
        margin-bottom: 15px;
        flex-wrap: wrap;
    }

    .datetime-group input, .datetime-group select {
        flex: 1;
        padding: 10px;
        background: var(--card-pink);
        border: 1px solid var(--soft-border);
        border-radius: 10px;
        outline: none;
        color: var(--dark-pink);
        font-size: 14px;
        text-align: center;
        box-sizing: border-box;
        min-width: 120px;
    }

    #due_day {
        background: #ffedf2;
        cursor: default;
    }

    .datetime-group input:focus, .datetime-group select:focus {
        border-color: var(--hot-pink);
        box-shadow: 0 0 5px rgba(255, 105, 180, 0.2);
    }

    .filter-sort-group {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 15px;
        background: #fdf5f8;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-day {
        text-decoration: none;
        padding: 8px 15px;
        border-radius: 12px;
        font-size: 14px;
        color: var(--dark-pink);
        transition: background 0.2s;
        font-weight: 600;
        white-space: nowrap;
    }

    .btn-day.active {
        background: var(--hot-pink);
        color: white;
        box-shadow: 0 2px 5px rgba(255, 105, 180, 0.4);
    }

    .info-header {
        text-align: center;
        color: var(--hot-pink);
        font-size: 14px;
        margin-bottom: 10px;
        font-weight: bold;
    }

    ul {
        list-style: none; 
        padding: 0; }
    
    li {
        background: white;
        margin-bottom: 12px;
        padding: 15px;
        border-radius: 15px;
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        border-left: 5px solid var(--soft-border);
    }

    .todo-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        gap: 10px;
    }

    .todo-details {
        font-size: 0.85em;
        color: #888;
        margin-top: 5px;
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    li.done {
        text-decoration: line-through;
        opacity: 0.6;
        border-left-color: #ccc;
    }

    .actions {
        display: flex;
        gap: 5px;
    }

    .actions a {
        text-decoration: none;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 14px;
        display: inline-block;
    }

    .btn-check { background: #d4edda; color: #155724; }
    .btn-edit { background: #fff3cd; color: #856404; }
    .btn-del { background: #f8d7da; color: #721c24; }

    .alert {
        background: #e6f7ef;
        color: #0f5132;
        padding: 10px;
        border-radius: 15px;
        margin-bottom: 20px;
        text-align: center;
    }

    .modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(255, 255, 255, 0.7);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        padding: 20px;
        box-sizing: border-box;
    }

    .modal-content {
        background: #fff0f5;
        padding: 30px;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(255, 105, 180, 0.4);
        text-align: center;
        border: 3px solid #ffb7c5;
        animation: bounceIn 0.5s;
        max-width: 400px;
        width: 100%;
    }

    .modal-title {
        color: #ff69b4;
        font-family: 'Brush Script MT', 'cursive';
        font-size: 3em;
        margin-bottom: 10px;
        text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8);
    }

    .modal-text {
        color: #d63384;
        font-size: 1.2em;
        margin-bottom: 20px;
    }

    .modal-close {
        background: #ff69b4;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 25px;
        cursor: pointer;
        font-weight: bold;
        transition: background 0.2s;
    }

    .modal-close:hover { background: #ff1493; }

    @keyframes bounceIn {
        0% { transform: scale(0.5); opacity: 0; }
        100% { transform: scale(1); opacity: 1; }
    }

    @media (max-width: 600px) {
        .container {
            width: 95%;
            padding: 20px;
            margin-top: 10px;
        }

        h1 {
            font-size: 1.8em; 
        }

        .input-group {
            flex-direction: column;
        }

        .btn-add {
            width: 100%;
        }

        .datetime-group {
            flex-direction: column;
        }

        .datetime-group input {
            width: 100%;
        }

        .filter-sort-group {
            justify-content: space-between;
        }
        
        .btn-day {
            flex: 1 1 40%;
            text-align: center;
            margin-bottom: 5px;
        }

        .todo-content {
            flex-direction: column;
            align-items: flex-start;
        }

        .actions {
            margin-top: 10px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
    }
</style>
</head>
<body>

<div class="container">
    <h1>🩷My Pinky Todo🩷</h1>

    <?php if($this->session->flashdata('msg')): ?>
        <div class="alert"><?= $this->session->flashdata('msg'); ?></div>
    <?php endif; ?>

    <?= form_open('todo/add', ['class' => 'add-todo-form']); ?>
        <div class="input-group">
            <input type="text" name="title" placeholder="Tulis rencana cantikmu..." required autocomplete="off">
            <button type="submit" class="btn-add">Tambah</button>
        </div>
        <div class="datetime-group">
            <input type="date" id="due_date" name="due_date" title="Tanggal Tenggat">
            <input type="time" name="due_time" title="Waktu Tenggat">
            <input type="text" id="due_day" name="due_day" placeholder="Hari" readonly>
        </div>
    <?= form_close(); ?>

    <div class="filter-sort-group">
        <a href="<?= site_url('todo?day=all') ?>" 
           class="btn-day <?= ($current_filter == 'all') ? 'active' : '' ?>">
           ∞ Semua
        </a>
        
        <a href="<?= site_url('todo?day=yesterday') ?>" 
           class="btn-day <?= ($current_filter == 'yesterday') ? 'active' : '' ?>">
           Kemarin
        </a>
        
        <a href="<?= site_url('todo?day=today') ?>" 
           class="btn-day <?= ($current_filter == 'today') ? 'active' : '' ?>">
           Hari Ini
        </a>
        
        <a href="<?= site_url('todo?day=tomorrow') ?>" 
           class="btn-day <?= ($current_filter == 'tomorrow') ? 'active' : '' ?>">
           Besok
        </a>
    </div>

    <div class="info-header">
        Sedang melihat: <?= $page_title ?>
    </div>

    <ul>
        <?php if(empty($todos)): ?>
            <li style="text-align:center; color:#aaa; display:block;">Belum ada rencana cantik di sini... 🌸</li>
        <?php else: ?>
            <?php foreach($todos as $t): ?>
                <li class="<?= $t->is_completed ? 'done' : '' ?>">
                    <div class="todo-content">
                        <span><?= htmlspecialchars($t->title) ?></span>
                        <div class="actions">
                            <a href="<?= site_url('todo/toggle_status/'.$t->id) ?>" class="btn-check">
                                <?= $t->is_completed ? '↺' : '✓' ?>
                            </a>
                            <a href="<?= site_url('todo/edit/'.$t->id) ?>" class="btn-edit">✎</a>
                            <a href="<?= site_url('todo/delete/'.$t->id) ?>" class="btn-del" onclick="return confirm('Hapus?')">✕</a>
                        </div>
                    </div>
                    
                    <div class="todo-details">
                        <?php if ($current_filter == 'all' && !empty($t->due_date)): ?>
                             <span style="color:var(--hot-pink);">📅 <?= date('d M Y', strtotime($t->due_date)) ?></span>
                        <?php endif; ?>

                        <?php if (!empty($t->due_day) && $current_filter != 'all'): ?>
                            <span>🗓️ <?= htmlspecialchars($t->due_day) ?></span>
                        <?php endif; ?>

                        <?php if (!empty($t->due_time)): ?>
                            <span>⏰ <?= htmlspecialchars($t->due_time) ?></span>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('due_date');
        const dayInput = document.getElementById('due_day');
        const daysOfWeek = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        function updateDay() {
            const dateValue = dateInput.value;
            if (dateValue) {
                const date = new Date(dateValue);
                if (!isNaN(date)) {
                    const dayIndex = date.getDay();
                    dayInput.value = daysOfWeek[dayIndex];
                }
            } else {
                dayInput.value = '';
            }
        }
        dateInput.addEventListener('change', updateDay);
    });

    function closeModal() {
        document.getElementById('welcomeModal').style.display = 'none';
        localStorage.setItem('hasVisited', 'true');
    }
    if (!localStorage.getItem('hasVisited')) {
        document.getElementById('welcomeModal').style.display = 'flex';
    }
</script>

</body>
</html>