import Joi from 'joi-browser';

export const validateSecurity = (response: object) => {
    const securitySchema = Joi.object()
        .keys({
            token: Joi.string().required()
        });

    return Joi.validate(response, securitySchema);
};

export const validateLoadUserData = (response: object) => {
    const loadUserSchema = Joi.object()
        .keys({
            email: Joi.string().email().required(),
            nick: Joi.string().required(),
            birthDate: Joi.string().required()
        })
        .allow(null)
    ;

    return Joi.validate(response, loadUserSchema);
};
