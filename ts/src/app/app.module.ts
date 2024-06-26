import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { AsideMenuComponent } from './components/aside-menu/aside-menu.component';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { SectionOneComponent } from './components/section-one/section-one.component';
import { SummaryComponent } from './components/summary/summary.component';
import { DiscussionTopicsComponent } from './components/discussion-topics/discussion-topics.component';
import { SectionTopicsComponent } from './components/section-topics/section-topics.component';

@NgModule({
  declarations: [
    AppComponent,
    AsideMenuComponent,
    HeaderComponent,
    FooterComponent,
    SectionOneComponent,
    SummaryComponent,
    DiscussionTopicsComponent,
    SectionTopicsComponent
  ],
  imports: [
    BrowserModule,
    FormsModule, 
    ReactiveFormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
