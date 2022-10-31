%form.form{action: ''}
%p.field.required
%label.label.required{for: 'name'} Full name
%input.text-input#name{type: 'text', name: 'name', required: true, value: 'Use Tab'}
%p.field.required.half
%label.label{for: 'email'} E-mail
%input.text-input#email{type: 'email', name: 'email', required: true}
%p.field.half
%label.label{for: 'phone'} Phone
%input.text-input#phone{type: 'phone', name: 'phone'}
%p.field.half.required.error
%label.label{for: 'login'} Login
%input.text-input#login{type: 'text', name: 'login', required: true, value: 'mican'}
-# %span.message Already taken
%p.field.half.required
%label.label{for: 'password'} Password
%input.text-input#password{type: 'password', name: 'password', required: true}
%div.field
%label.label Sport?
%ul.checkboxes
- %w(Football Basketball Volleyball Golf Swimming).each_with_index do |item,i|
%li.checkbox
%input.checkbox-input{name: 'choice', type: 'checkbox', value: i, id: "choice-#{i}"}/
%label.checkbox-label{:for => "choice-#{i}"}= item
%div.field
%label.label Favourite JS framework
%ul.options
- %w(React Vue Angular Riot Polymer Ember Meteor Knockout).each_with_index do |item,i|
%li.option
%input.option-input{name: 'option', type: 'radio', value: i, id: "option-#{i}"}/
%label.option-label{:for => "option-#{i}"}= item
%p.field
%label.label{for: "about"} About
%textarea.textarea#about{cols: 50, name: "about", rows: 4}
%p.field.half
%label.label{for: "select"} Position
%select#select.select
%option{value: '', selected: true}
%option{value: "ceo"} CEO
%option{value: "front-end"} Front-end developer
%option{value: "back-end"} Back-end developer
%p.field.half
%input.button{type: "submit", value: "Send"}
