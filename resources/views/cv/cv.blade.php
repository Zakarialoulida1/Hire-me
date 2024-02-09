<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>My CV</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1, h2, h3 {
        color: #333;
    }
    .section {
        margin-bottom: 20px;
    }
    .section h2 {
        border-bottom: 2px solid #333;
        padding-bottom: 5px;
    }
    .section ul {
        list-style-type: none;
        padding: 0;
    }
    .section ul li {
        margin-bottom: 5px;
    }
</style>
</head>
<body>

<div class="container">
    <header>
        <div>
        <h1>{{$user->name}}</h1>
        <p>{{$user->JobTitle}}</p>
        </div>
        <img src="" alt="">
    </header>

    <div class="section">
        <h2>Personal Information</h2>
        <ul>
            @foreach ($cursuses as $cursus)
    <p>{{ $cursus->name }}</p>
@endforeach

            <li><strong>Phone:</strong> (123) 456-7890</li>
            <li><strong>Address:</strong> 123 Street, City, Country</li>
        </ul>
    </div>

    <div class="section">
        <h2>Education</h2>
        <ul>
            @foreach ($cursuses as $cursus)
    

            <li><strong>{{$cursus->institution}}</strong> {{$cursus->degree }}</li>
            <li><strong>Year:</strong> {{$cursus->start_year}} - {{$cursus->end_year}}</li>
       
            @endforeach
        </ul>
    </div>

    <div class="section">
        <h2>Experience</h2>
        <ul>
            @foreach ($experiences as $experience)
   


            <li><strong>{{ $experience->company }} :</strong> {{ $experience->position }}</li>
            <li><strong>Year:</strong> {{$experience->start_year}} - {{$experience->end_year}}</li>
       
         
            @endforeach
        </ul>
    </div>

    <div class="section">
        <h2>Skills</h2>
        <ul>
            @foreach ($competences as $competence)
            <li>{{ $competence->name }}</li>
        @endforeach
        </ul>
    </div>
    
    <div class="section">
        <h2>Languages</h2>
        <ul>
            @foreach ($languages as $language)
            <li><strong> {{$language->language}} : </strong> {{$language->proficiency}} </li>
       
        @endforeach
        </ul>
    </div>
</div>

</body>
</html>
