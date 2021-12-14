@extends('layouts.app')
@section('content')
<h1>task</h1>
<div style="overflow-x: auto;">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">ID</th>
                <th>Название</th>
                <th>Дата постановки задачи</th>
                <th>Дедлайн</th>
                <th>Дата завершения</th>
                <th>Описание</th>
                <th>Постановщик</th>
                <th>Исполнитель</th>
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td class="text-center">{{ $task['id'] }}</td>
                <td>{{ $task['task_name'] }}</td>
                <td>{{ $task['start_task'] }}</td>
                <td>{{ $task['must_end_task'] }}</td>
                <td>{{ $task['end_task'] }}</td>
                <td>{{ $task['task_description'] }}</td>
                <td>{{ $task['executor_id'] }}</td>
                <td>{{ $task['creator_id'] }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection