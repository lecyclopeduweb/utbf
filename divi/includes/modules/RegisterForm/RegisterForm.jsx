// External Dependencies
import React, { Component } from 'react';


class UtbfRegisterForm extends Component {

  static slug = 'UTBF_register_form';

  /**
   * Module render in VB
   * Basically UTBF_CTA_Parent->render() equivalent in JSX
   */
  render() {
    const user_login = this.props.label_user_login || 'Identifiant';
    const password = this.props.label_password || 'Mot de passe';
    const firstName = this.props.label_first_name || 'Prénom';
    const lastName = this.props.label_last_name || 'Nom';
    const address = this.props.label_address || 'Adresse';
    const zipCode = this.props.label_zip_code || 'Code postal';
    const city = this.props.label_city || 'Ville';
    const phone = this.props.label_phone || 'Téléphone';
    const phone2 = this.props.label_phone_2 || 'Téléphone 2';
    const mail = this.props.label_mail || 'E-mail';
    const button = this.props.text_button || 'S\'inscrire';

    return (
      <form  className="utbf-form" id="utbf-register-form" method="post" action="">
          <div  className="utbf-form__row">
              <div  className="utbf-form__half-col">
                  <label>
                      {user_login}*
                  </label>
                  <input type="text" name="user_login" value="" />
              </div>
              <div  className="utbf-form__half-col">
                  <label>
                      {password}*
                  </label>
                  <input type="password" name="password" value="" />
              </div>
          </div>
          <div  className="utbf-form__row">
              <div  className="utbf-form__half-col">
                  <label>
                      {firstName}*
                  </label>
                  <input type="text" name="first_name" value="" />
              </div>
              <div  className="utbf-form__half-col">
                  <label>
                      {lastName}*
                  </label>
                  <input type="text" name="last_name" value="" />
              </div>
          </div>
            <div className="utbf-form__row">
              <div className="utbf-form__full-col">
                  <label>
                      {address}*
                  </label>
                  <input type="text" name="address" value="" />
              </div>
          </div>
          <div className="utbf-form__row">
              <div className="utbf-form__half-col">
                  <label>
                      {zipCode}*
                  </label>
                  <input type="number" name="zip-code" value="" />
              </div>
              <div className="utbf-form__half-col">
                  <label>
                      {city}*
                  </label>
                  <input type="text" name="city" value="" />
              </div>
          </div>
          <div className="utbf-form__row">
              <div className="utbf-form__half-col">
                  <label>
                      {phone}*
                  </label>
                  <input type="number" name="phone" value="" />
              </div>
              <div className="utbf-form__half-col">
                  <label>
                      {phone2}
                  </label>
                  <input type="number" name="phone_2" value="" />
              </div>
          </div>
          <div className="utbf-form__row">
              <div className="utbf-form__full-col">
                  <label>
                      {mail}*
                  </label>
                  <input type="email" name="user_email" value="" />
              </div>
          </div>
          <div className="utbf-form__row justify-content-center align-items-center space-mt-30">
            <div className="button button-primary button-large">
                {button}
            </div>
        </div>
      </form>
    );
  }
}

export default UtbfRegisterForm;
