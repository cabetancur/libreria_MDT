<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar autor</title>
</head>
<body>
    <main>
        <h1>Editar autor</h1>

        <form action="{{ route('authors.update', $author) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Nombre</label>
                <input id="name" name="name" type="text" value="{{ old('name', $author->name) }}" required>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nationality">Nacionalidad</label>
                <input id="nationality" name="nationality" type="text" value="{{ old('nationality', $author->nationality) }}">
                @error('nationality')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="birth_date">Fecha de nacimiento</label>
                <input id="birth_date" name="birth_date" type="date" value="{{ old('birth_date', $author->birth_date) }}">
                @error('birth_date')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Actualizar autor</button>
        </form>

        <p><a href="{{ route('authors.index') }}">Volver a autores</a></p>
    </main>
</body>
</html>
