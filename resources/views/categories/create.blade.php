<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear categoría</title>
</head>
<body>
    <main>
        <h1>Crear categoría</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div>
                <label for="name">Nombre</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description">Descripción</label>
                <textarea id="description" name="description" required>{{ old('description') }}</textarea>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Guardar categoría</button>
        </form>

        <p><a href="{{ route('categories.index') }}">Volver a categorías</a></p>
    </main>
</body>
</html>
