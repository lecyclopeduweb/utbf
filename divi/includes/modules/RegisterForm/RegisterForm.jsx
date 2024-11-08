// External Dependencies
import React, { Component } from 'react';


class UtbfRegisterForm extends Component {

  static slug = 'UTBF_register_form';

  /**
   * Module render in VB
   * Basically UTBF_CTA_Parent->render() equivalent in JSX
   */
  render() {
    const title_infos = this.props.title_informations || 'Informations';
    const title_legal_guardian = this.props.title_legal_guardian || 'Représentant Légal';
    const title_child = this.props.title_child || 'Enfant';
    const title_emergency = this.props.title_emergency || 'En cas d’urgence';

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

    const legalGuardianFirstName = this.props.label_legal_guardian_first_name || 'Prénom';
    const legalGuardianLastName = this.props.label_legal_guardian_last_name || 'Nom';
    const legalGuardianAddress = this.props.label_legal_guardian_address || 'Adresse';
    const legalGuardianZipCode = this.props.label_legal_guardian_zip_code || 'Code postal';
    const legalGuardianCity = this.props.label_legal_guardian_city || 'Ville';
    const legalGuardianPhone = this.props.label_legal_guardian_phone || 'Téléphone';
    const legalGuardianPhone2 = this.props.label_legal_guardian_phone_2 || 'Téléphone 2';
    const legalGuardianMail = this.props.label_legal_guardian_email || 'E-mail';

    const childFirstName = this.props.label_child_first_name || 'Prénom';
    const childLastName = this.props.label_child_last_name || 'Nom';
    const childClassroom = this.props.label_child_classroom || 'Classe';
    const childSchool = this.props.label_child_school || 'École';
    const childOtherSchool = this.props.label_child_other_school || 'Autre';
    const childBirthday = this.props.label_child_birthday || 'Date de naissance';
    const childMedicalTreatments = this.props.label_child_medical_treatments || 'Traitement en cours';
    const childSpecificAspects = this.props.label_child_specific_aspects || 'Eléments particuliers à signaler (Allergies alimentaires, asthme etc…)';
    const childRecommendations = this.props.label_child_recommendations || 'Des recommandations / commentaires utiles à savoir sur l’enfant ?';

    return (
        <form  className="utbf-form" id="utbf-register-form" method="post" action="">
            {/* Section: Informations */}
            <h2>{title_infos}</h2>
            <div className="utbf-form__row">
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
                    <i>Le mot de passe doit avoir au moins 8 caractères, un nombre, une majuscule, un caractère spécial</i>
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
                    <textarea name="address" rows="5" cols="33"></textarea>
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

            {/* Section: Legal Guardian */}
            <h2 className="space-mt-30">{title_legal_guardian} 2</h2>
            <div className="utbf-form__row">
                <div className="utbf-form__half-col">
                    <label>{legalGuardianFirstName}</label>
                    <input type="text" name="user__legal_guardian__first_name" value="" />
                </div>
                <div className="utbf-form__half-col">
                    <label>{legalGuardianLastName}</label>
                    <input type="text" name="user__legal_guardian__last_name" value="" />
                </div>
            </div>
            <div className="utbf-form__row">
                <div className="utbf-form__full-col">
                    <label>{legalGuardianAddress}</label>
                    <textarea name="user__legal_guardian__address" rows="5" cols="33"></textarea>
                </div>
            </div>
            <div className="utbf-form__row">
                <div className="utbf-form__half-col">
                    <label>{legalGuardianZipCode}</label>
                    <input type="number" name="user__legal_guardian__zip_code" value="" />
                </div>
                <div className="utbf-form__half-col">
                    <label>{legalGuardianCity}</label>
                    <input type="text" name="user__legal_guardian__city" value="" />
                </div>
            </div>
            <div className="utbf-form__row">
                <div className="utbf-form__half-col">
                    <label>{legalGuardianPhone}</label>
                    <input type="number" name="user__legal_guardian__phone" value="" />
                </div>
                <div className="utbf-form__half-col">
                    <label>{legalGuardianPhone2}</label>
                    <input type="number" name="user__legal_guardian__phone_2" value="" />
                </div>
            </div>
            <div className="utbf-form__row">
                <div className="utbf-form__full-col">
                    <label>{legalGuardianMail}</label>
                    <input type="email" name="user__legal_guardian__email" value="" />
                </div>
            </div>

            {/* Section: Child */}
            <h2 className="space-mt-30">{title_child}</h2>
            {this.props.infos_bloc_child && (
                <em>
                    {this.props.infos_bloc_child}
                </em>
            )}
            <div className="utbf-form__row space-mt-20">
                <div className="utbf-form__half-col">
                    <label>{childFirstName}*</label>
                    <input type="text" name="user__child__first_name" value="" />
                </div>
                <div className="utbf-form__half-col">
                    <label>{childLastName}*</label>
                    <input type="text" name="user__child__last_name" value="" />
                </div>
            </div>
            <div className="utbf-form__row">
                <div className="utbf-form__half-col">
                    <label>{childClassroom}*</label>
                    <select name="user__child__user__child__classroom">
                        <option value="">--Selectionner une option--</option>
                    </select>
                </div>
                <div className="utbf-form__half-col">
                    <label>{childSchool}*</label>
                    <select name="user__child__school">
                        <option value="">--Selectionner une option--</option>
                    </select>
                </div>
            </div>
            <div className="utbf-form__row">
                <div className="utbf-form__full-col">
                    <label>{childOtherSchool}*</label>
                    <input type="text" name="user__child__other_school" value="" />
                </div>
            </div>
            <div className="utbf-form__row">
                <div className="utbf-form__half-col">
                    <label>{childBirthday}*</label>
                    <input type="date" name="user__child__birthday" value="" />
                </div>
                <div className="utbf-form__half-col">
                    <label>{childMedicalTreatments}</label>
                    <div class="d-flex h-100 align-items-center">
                        <label className='space-mr-10'>
                            <input type="radio" name="user__child__medical_treatments" value="yes" />
                            oui
                        </label>
                        <label>
                            <input type="radio" name="user__child__medical_treatments" value="no" />
                            non
                        </label>
                    </div>
                </div>
            </div>
            <div className="utbf-form__row">
                <div className="utbf-form__half-col">
                    <label>{childSpecificAspects}</label>
                    <textarea name="user__child__specific_aspects" rows="5" cols="33"></textarea>
                </div>
                <div className="utbf-form__half-col">
                    <label>{childRecommendations}</label>
                    <textarea name="user__child__recommendations" rows="5" cols="33"></textarea>
                </div>
            </div>

            {/* Submit Button */}
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
