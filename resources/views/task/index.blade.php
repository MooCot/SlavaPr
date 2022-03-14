@extends('layouts.app')
@section('title')История задач MH Task Planer @endsection
@section('content')
<div class="dashboard-container">
    <div class="container-title">
        <h1 class="container-title__text">Список завершенных задач</h1>
    </div>    
    <div class="container__content" style="overflow-x: auto;">
        <table class="table">
            <thead>
                <tr class="table__thead">
                    <th class="table__text-center table__text-id table__column-space">ID</th>
                    <th class="table__task-name table__column-space">Название</th>
                    <th class="table__task-date table__column-space">Дата постановки задачи</th>
                    <th class="table__task-date-result table__column-space">Дедлайн</th>
                    <th class="table__task-data-complete ">Дата завершения</th>
                    <th class="table__task-desc ">Описание</th>
                    <th class="table__task-fio ">ФИО</th>
                    <th class="table__text-edit"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tasks as $task)
                <tr class="table__border-top">
                    <td class="table__text-center table__text-number">{{ $task->id }}</td>
                    <!-- <td class="table__tbody-namesur table__name-length">{{ substr($task->task_name, 0,  50)."..." }}</td> -->
                    <td class="table__tbody-namesur table__name-length">{{ $task->task_name }}</td>
                    <td class="table__tbody-namesur">{{ $task->start_task_time}}</br> {{ $task->start_task_date}}</td>
                    <td class="table__tbody-namesur">{{ $task->must_end_task_time}}</br> {{ $task->must_end_task_date}}</td>
                    <td class="table__tbody-namesur">{{$task->end_task_time}}</br> {{ $task->end_task_date}}</td>
                    <td class="table__tbody-namesur table__desc-length table__tasks-padding">{{ substr($task->task_description, 0,  250)."..."  }}</td>
                    <td class="table__task-fio ">
                        <div class="table__task-fio-pos">
                            <span class="table__task-title-text">Постановщик: </span>
                            <span>{{ $task->creator_name }} {{ $task->creator_surname }}</span>
                        </div>
                        <div class="table__task-fio-pos">
                            <span class="table__task-title-text">Исполнитель: </span>
                            <span>{{ $task->executor_name }} {{ $task->executor_surname }}</span>
                        </div>                     
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
        <div class="container__pagination">
            {{ $tasks->links() }}  
        </div>
    </div>
</div>

{{-- <h1>task</h1>

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
                <th>
                    <th>Постановщик</th>
                    <th>Исполнитель</th>
                </th>
                
                <th class="text-right"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td class="text-center">{{ $task->id }}</td>
                <td>{{ $task->task_name }}</td>
                <td>{{ $task->start_task }}</td>
                <td>{{ $task->must_end_task }}</td>
                <td>{{ $task->end_task }}</td>
                <td>{{ $task->task_description }}</td>
                <td>{{ $task->creator_name }} {{ $task->creator_surname }}</td>
                <td>{{ $task->executor_name }} {{ $task->executor_surname }}</td>
                <td></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> --}}
@endsection