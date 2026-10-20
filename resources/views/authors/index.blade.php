<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autores</title>
</head>
<body>
    <main>
        <h1>Autores</h1>

        <p><a href="{{ route('authors.create') }}">Crear autor</a></p>

        @if ($authors->isEmpty())
            <p>Aún no hay autores.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Nacionalidad</th>
                        <th>Fecha de nacimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->nationality ?: '—' }}</td>
                            <td>{{ $author->birth_date ?: '—' }}</td>
                            <td>
                                <a href="{{ route('authors.edit', $author) }}">Editar</a>
                                <form action="{{ route('authors.destroy', $author) }}" method="POST">
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
