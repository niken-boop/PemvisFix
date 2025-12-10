<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tugas</title>
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
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: var(--card-pink);
            padding: 40px;
            border-radius: 25px;
            text-align: center;
            border: 2px solid white;
            box-shadow: 0 10px 25px rgba(255,105,180,0.2);
        }

        h2 {
            color: var(--dark-pink);
            margin-bottom: 30px;
            font-size: 1.8em;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
            width: 100%;
        }

        input[type="text"], 
        input[type="date"], 
        input[type="time"] {
            width: 100%;
            padding: 15px;
            border-radius: 15px;
            border: 2px solid var(--soft-border);
            outline: none;
            text-align: center;
            color: var(--dark-pink);
            box-sizing: border-box;
            font-size: 16px;
            background: white;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        input:focus {
            border-color: var(--hot-pink);
            box-shadow: 0 0 10px rgba(255, 105, 180, 0.2);
        }

        input[name="title"] {
            font-weight: bold;
            font-size: 18px;
        }

        .datetime-group {
            display: flex;
            gap: 10px;
            width: 100%;
        }

        .datetime-group input {
            flex: 1;
            margin: 0;
        }

        #due_day {
            background-color: #ffedf2;
            cursor: default;
            color: #b04a75;
            font-weight: 600;
        }

        .btn-save, .btn-cancel {
            padding: 12px 30px;
            border-radius: 50px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
            transition: transform 0.1s;
            display: inline-block;
            margin-top: 10px;
        }

        .btn-save {
            background: var(--hot-pink);
            color: white;
            border: none;
            width: 100%;
        }
        
        .btn-save:hover {
            background: #ff1493;
        }

        .btn-cancel {
            background: white;
            color: var(--hot-pink);
            border: 2px solid var(--hot-pink);
            width: 100%;
            box-sizing: border-box;
        }

        @media (max-width: 500px) {
            .container {
                padding: 25px;
            }

            .datetime-group {
                flex-direction: column;
            }

            .btn-save, .btn-cancel {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2 style="color: #d63384;">✏️ Edit Rencana</h2>
    
    <?= form_open('todo/edit/'.$todo->id); ?>
    
        <input type="text" name="title" value="<?= htmlspecialchars($todo->title) ?>" required autocomplete="off" placeholder="Nama Rencana">
        
        <div class="datetime-group">
            <input type="date" id="due_date" name="due_date" value="<?= htmlspecialchars($todo->due_date ?? '') ?>" title="Tanggal Tenggat">
            <input type="time" name="due_time" value="<?= htmlspecialchars($todo->due_time ?? '') ?>" title="Waktu Tenggat">
        </div>

        <input type="text" id="due_day" name="due_day" 
            value="<?= htmlspecialchars($todo->due_day ?? '') ?>" 
            readonly 
            title="Hari terisi otomatis berdasarkan tanggal"
            placeholder="Hari">
        
        <a href="<?= site_url('todo') ?>" class="btn-cancel">Batal</a>
        <button type="submit" name="submit" value="yes" class="btn-save">Simpan</button>
        
    <?= form_close(); ?>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dateInput = document.getElementById('due_date');
        const dayInput = document.getElementById('due_day');
        
        const daysOfWeek = [
            'Minggu', 'Senin', 'Selasa', 'Rabu', 
            'Kamis', 'Jumat', 'Sabtu'
        ];

        function updateDay() {
            const dateValue = dateInput.value;
            
            if (dateValue) {
                const date = new Date(dateValue + 'T00:00:00'); 
                if (!isNaN(date)) {
                    const dayIndex = date.getDay();
                    dayInput.value = daysOfWeek[dayIndex];
                } else {
                    dayInput.value = '';
                }
            } else {
                dayInput.value = '';
            }
        }
        updateDay(); 
        dateInput.addEventListener('change', updateDay);
    });
</script>

</body>
</html>