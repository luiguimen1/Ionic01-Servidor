/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { PersonaDaoProvider } from '../../providers/persona-dao/persona-dao';
import { AlertController } from 'ionic-angular';
import { HomePage } from '../home/home';
/**
 * Generated class for the VistaModiPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@IonicPage()
@Component({
    selector: 'page-vista-modi',
    templateUrl: 'vista-modi.html',
})
export class VistaModiPage {
    ID;
    ElFormu: FormGroup;
    LaData;
    constructor(
        public navCtrl: NavController,
        public navParams: NavParams,
        public fb: FormBuilder,
        public envio: PersonaDaoProvider,
        private alertCtrl: AlertController) {
        this.LaData={cc:"",nombre:"",apellido:"",URL:"",genero:"",perfil:"",id:""};
        this.ID = navParams.get('id');
        this.tarerInfo(this.ID);
        this.CargarValida();
    }

    
    
    ionViewDidLoad() {
        console.log('ionViewDidLoad VistaModiPage');
    }

    CargarValida() {
    let ladata = this.LaData;
        this.ElFormu = this.fb.group({
            CC: [ladata.cc, [Validators.required]],
            NOM: [ladata.nombre, [Validators.required, Validators.minLength(5), Validators.maxLength(40)]],
            APE: [ladata.apellido, [Validators.required, Validators.minLength(5), Validators.maxLength(40)]],
            URL: [ladata.URL, [Validators.pattern(/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/)]],
            Genero: [ladata.genero, [Validators.required]],
            perfil: [ladata.perfil, [Validators.required, Validators.minLength(10), Validators.maxLength(255)]]
        });
    }

    DataPerfil;
    tarerInfo(ID) {
        this.DataPerfil = this.envio.buscarXiD(ID);
        this.DataPerfil.subscribe(data => {
            this.LaData = data;
            this.CargarValida();
        }, err => {
            this.presentAlert("Error", "Existe un error con el servidor");
        });
    }

    cancelar() {
        this.navCtrl.setRoot(HomePage);
    }



    capturarDatos() {
        let Persona = this.ElFormu.value;
        Persona.ID = this.ID;
        let alert = this.alertCtrl.create({
            title: 'Confirme la Modificación',
            message: 'Del Usuario <b>' + Persona.NOM + '</b>',
            buttons: [{
                    text: 'Cancel',
                    role: 'cancel',
                    handler: () => {
                    }
                },
                {
                    text: 'Confirmar',
                    handler: () => {
                        let laRespuesta = this.envio.modicarPer(Persona);
                        laRespuesta.subscribe(data => {
                        let Resputa = data;
                        if(Resputa.resp == "ok"){
                                this.presentAlert("Confirmación", "Los datos del usuario <b>" + Persona.NOM + "</b> Fueron Modicados");
                                this.navCtrl.setRoot(HomePage);
                            } else {
                                this.presentAlert("Error", "Existe un error con el servidor");
                            }
                        }, err => {
                            this.presentAlert("Error", "Existe un error con el servidor");
                        });
                    }
                }
            ]
        });
        alert.present();
    }

    presentAlert(titulo, Mensaje) {
        let alert = this.alertCtrl.create({
            title: titulo,
            subTitle: Mensaje,
            buttons: ['Aceptar']
        });
        alert.present();
    }

}
