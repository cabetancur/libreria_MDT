<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar categoría</title>
</head>
<body>
    <main>
        <h1>Editar categoría</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="name">Nombre</label>
                <input id="name" name="name" type="text" value="{{ old('name', $category->name) }}" required>
                @error('name')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description">Descripción</label>
                <textarea id="description" name="description" required>{{ old('description', $category->description) }}</textarea>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Actualizar categoría</button>
        </form>

        <p><a href="{{ route('categories.index') }}">Volver a categorías</a></p>
    </main>
</body>
</html>
