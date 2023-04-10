@csrf

<label for="">Titulo</label>
<input type="text" name="title" value="{{old("title", $post->title)}}">

<label for="">Slug</label>
<input type="text" name="slug" value="{{old("slug", $post->slug)}}">

<label for="">Categoria</label>
<select name="category_id">
    <option value=""></option>
    @foreach ($categories as $title =>$id)
        <option {{old("category_id", $post->category_id) == $id ? "selected" : ""}} value="{{$id}}">{{$title}}</option>
    @endforeach
</select>

<label for="">Posteado</label>
<select name="posted">
    <option {{old("posted", $post->posted)== "yes" ? "selected" : ""}} value="yes">No</option>
    <option {{old("posted", $post->posted)== "not" ? "selected" : ""}} value="not">Si</option>
</select>

<label for="">Contenido</label>
<textarea name="content">{{old("content", $post->content)}}</textarea>

<label for="">Descripcion</label>
<textarea name="description">{{old("description", $post->description)}}</textarea>

@if ( isset($task) && $task == "edit")
    <label for="">Imagen</label>
    <input type="file" name="image">
@endif

<button type="submit" name="">Enviar</button>