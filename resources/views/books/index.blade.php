<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>
</head>
<body>
    <main>
        <h1>Libros</h1>

        <p><a href="{{ route('books.create') }}">Crear libro</a></p>

        @if ($books->isEmpty())
            <p>Aún no hay libros.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Año de publicación</th>
                        <th>Categoría</th>
                        <th>Autores</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->publication_year ?: '—' }}</td>
                            <td>{{ $book->category->name }}</td>
                            <td>{{ $book->authors->pluck('name')->join(', ') ?: '—' }}</td>
                            <td>{{ $book->description ?: '—' }}</td>
                            <td>
                                <a href="{{ route('books.edit', $book) }}">Editar</a>
                                <form action="{{ route('books.destroy', $book) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </main>
</body>
</html>
