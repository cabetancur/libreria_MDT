<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar libro</title>
</head>
<body>
    <main>
        <h1>Editar libro</h1>

        <form action="{{ route('books.update', $book) }}" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label for="title">Título</label>
                <input id="title" name="title" type="text" value="{{ old('title', $book->title) }}" required>
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="publication_year">Año de publicación</label>
                <input id="publication_year" name="publication_year" type="number" min="0" max="2155" value="{{ old('publication_year', $book->publication_year) }}">
                @error('publication_year')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id">Categoría</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="authors">Autores</label>
                @php($selectedAuthors = old('authors', $book->authors->modelKeys()))
                <select id="authors" name="authors[]" multiple>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}" @selected(in_array($author->id, $selectedAuthors))>
                            {{ $author->name }}
                        </option>
                    @endforeach
                </select>
                @error('authors')
                    <p>{{ $message }}</p>
                @enderror
                @error('authors.*')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description">Descripción</label>
                <textarea id="description" name="description">{{ old('description', $book->description) }}</textarea>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <button type="submit">Actualizar libro</button>
        </form>

        <p><a href="{{ route('books.index') }}">Volver a libros</a></p>
    </main>
</body>
</html>
