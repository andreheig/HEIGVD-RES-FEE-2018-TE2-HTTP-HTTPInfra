import { Component } from '@angular/core';
import { Http } from '@angular/http';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-docker',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
  
})

export class AppComponent {
  title = 'Docker Administration';
  constructor(private http: HttpClient){
  }
  getImage(){
  	console.log("hello");
  	this.http.get("http://localhost:2375/").subscribe(data => {
      console.log(data);
    });
  }
  }
}

